<?php
use setasign\Fpdi\Fpdi;
require ('vendor_editpdf/autoload.php');



////////////////////// FUNCION GD IMG

class VariableStream
{
    private $varname;
    private $position;

    function stream_open($path, $mode, $options, &$opened_path)
    {
        $url = parse_url($path);
        $this->varname = $url['host'];
        if(!isset($GLOBALS[$this->varname]))
        {
            trigger_error('Global variable '.$this->varname.' does not exist', E_USER_WARNING);
            return false;
        }
        $this->position = 0;
        return true;
    }

    function stream_read($count)
    {
        $ret = substr($GLOBALS[$this->varname], $this->position, $count);
        $this->position += strlen($ret);
        return $ret;
    }

    function stream_eof()
    {
        return $this->position >= strlen($GLOBALS[$this->varname]);
    }

    function stream_tell()
    {
        return $this->position;
    }

    function stream_seek($offset, $whence)
    {
        if($whence==SEEK_SET)
        {
            $this->position = $offset;
            return true;
        }
        return false;
    }
    
    function stream_stat()
    {
        return array();
    }
}

//////////////////// FIN FUNCION GD IMG

if(function_exists('openssl_encrypt'))
{
    function RC4($key, $data)
    {
        return openssl_encrypt($data, 'RC4-40', $key, OPENSSL_RAW_DATA);
    }
}
elseif(function_exists('mcrypt_encrypt'))
{
    function RC4($key, $data)
    {
        return @mcrypt_encrypt(MCRYPT_ARCFOUR, $key, $data, MCRYPT_MODE_STREAM, '');
    }
}
else
{
    function RC4($key, $data)
    {
        static $last_key, $last_state;

        if($key != $last_key)
        {
            $k = str_repeat($key, 256/strlen($key)+1);
            $state = range(0, 255);
            $j = 0;
            for ($i=0; $i<256; $i++){
                $t = $state[$i];
                $j = ($j + $t + ord($k[$i])) % 256;
                $state[$i] = $state[$j];
                $state[$j] = $t;
            }
            $last_key = $key;
            $last_state = $state;
        }
        else
            $state = $last_state;

        $len = strlen($data);
        $a = 0;
        $b = 0;
        $out = '';
        for ($i=0; $i<$len; $i++){
            $a = ($a+1) % 256;
            $t = $state[$a];
            $b = ($b+$t) % 256;
            $state[$a] = $state[$b];
            $state[$b] = $t;
            $k = $state[($state[$a]+$state[$b]) % 256];
            $out .= chr(ord($data[$i]) ^ $k);
        }
        return $out;
    }
}



class editpdf extends Fpdi
{




///////////////////////// INICIA PROTECCION //////////////////////


    protected $encrypted = false;  //whether document is protected
    protected $Uvalue;             //U entry in pdf document
    protected $Ovalue;             //O entry in pdf document
    protected $Pvalue;             //P entry in pdf document
    protected $enc_obj_id;         //encryption object id

    /**
    * Function to set permissions as well as user and owner passwords
    *
    * - permissions is an array with values taken from the following list:
    *   copy, print, modify, annot-forms
    *   If a value is present it means that the permission is granted
    * - If a user password is set, user will be prompted before document is opened
    * - If an owner password is set, document can be opened in privilege mode with no
    *   restriction if that password is entered
    */
    function SetProtection($permissions=array(), $user_pass='', $owner_pass=null)
    {
        $options = array('print' => 4, 'modify' => 8, 'copy' => 16, 'annot-forms' => 32 );
        $protection = 192;
        foreach($permissions as $permission)
        {
            if (!isset($options[$permission]))
                $this->Error('Incorrect permission: '.$permission);
            $protection += $options[$permission];
        }
        if ($owner_pass === null)
            $owner_pass = uniqid(rand());
        $this->encrypted = true;
        $this->padding = "\x28\xBF\x4E\x5E\x4E\x75\x8A\x41\x64\x00\x4E\x56\xFF\xFA\x01\x08".
                        "\x2E\x2E\x00\xB6\xD0\x68\x3E\x80\x2F\x0C\xA9\xFE\x64\x53\x69\x7A";
        $this->_generateencryptionkey($user_pass, $owner_pass, $protection);
    }

/****************************************************************************
*                                                                           *
*                              Private methods                              *
*                                                                           *
****************************************************************************/

    function _putstream($s)
    {
        if ($this->encrypted)
            $s = RC4($this->_objectkey($this->n), $s);
        parent::_putstream($s);
    }

    function _textstring($s)
    {
        if (!$this->_isascii($s))
            $s = $this->_UTF8toUTF16($s);
        if ($this->encrypted)
            $s = RC4($this->_objectkey($this->n), $s);
        return '('.$this->_escape($s).')';
    }

    /**
    * Compute key depending on object number where the encrypted data is stored
    */
    function _objectkey($n)
    {
        return substr($this->_md5_16($this->encryption_key.pack('VXxx',$n)),0,10);
    }

    function _putresources2()
    {
        parent::_putresources();
        if ($this->encrypted) {
            $this->_newobj();
            $this->enc_obj_id = $this->n;
            $this->_put('<<');
            $this->_putencryption();
            $this->_put('>>');
            $this->_put('endobj');
        }
    }

    function _putencryption()
    {
        $this->_put('/Filter /Standard');
        $this->_put('/V 1');
        $this->_put('/R 2');
        $this->_put('/O ('.$this->_escape($this->Ovalue).')');
        $this->_put('/U ('.$this->_escape($this->Uvalue).')');
        $this->_put('/P '.$this->Pvalue);
    }

    function _puttrailer()
    {
        parent::_puttrailer();
        if ($this->encrypted) {
            $this->_put('/Encrypt '.$this->enc_obj_id.' 0 R');
            $this->_put('/ID [()()]');
        }
    }

    /**
    * Get MD5 as binary string
    */
    function _md5_16($string)
    {
        return md5($string, true);
    }

    /**
    * Compute O value
    */
    function _Ovalue($user_pass, $owner_pass)
    {
        $tmp = $this->_md5_16($owner_pass);
        $owner_RC4_key = substr($tmp,0,5);
        return RC4($owner_RC4_key, $user_pass);
    }

    /**
    * Compute U value
    */
    function _Uvalue()
    {
        return RC4($this->encryption_key, $this->padding);
    }

    /**
    * Compute encryption key
    */
    function _generateencryptionkey($user_pass, $owner_pass, $protection)
    {
        // Pad passwords
        $user_pass = substr($user_pass.$this->padding,0,32);
        $owner_pass = substr($owner_pass.$this->padding,0,32);
        // Compute O value
        $this->Ovalue = $this->_Ovalue($user_pass,$owner_pass);
        // Compute encyption key
        $tmp = $this->_md5_16($user_pass.$this->Ovalue.chr($protection)."\xFF\xFF\xFF");
        $this->encryption_key = substr($tmp,0,5);
        // Compute U value
        $this->Uvalue = $this->_Uvalue();
        // Compute P value
        $this->Pvalue = -(($protection^255)+1);
    }


//////////////////////// FINALIZA PROTECCION ////////////////



///////////////////////////// TRANSPARENCIA //////////////////////////




var $extgstates = array();

    // alpha: real value from 0 (transparent) to 1 (opaque)
    // bm:    blend mode, one of the following:
    //          Normal, Multiply, Screen, Overlay, Darken, Lighten, ColorDodge, ColorBurn,
    //          HardLight, SoftLight, Difference, Exclusion, Hue, Saturation, Color, Luminosity
    function SetAlpha($alpha, $bm='Normal')
    {
        // set alpha for stroking (CA) and non-stroking (ca) operations
        $gs = $this->AddExtGState(array('ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm));
        $this->SetExtGState($gs);
    }

    function AddExtGState($parms)
    {
       // $n=0;
        $n = count($this->extgstates)+1;
        //$this->extgstates[$n]["parms"] = $parms; <------ AQUI!!!!
        return $n;
    }

    function SetExtGState($gs)
    {
        $this->_out(sprintf('/GS%d gs', $gs));
    }

    function _enddoc()
    {
        if(!empty($this->extgstates) && $this->PDFVersion<'1.4')
            $this->PDFVersion='1.4';
        parent::_enddoc();
    }

    function _putextgstates()
    {
        for ($i = 1; $i <= count($this->extgstates); $i++)
        {
            $this->_newobj();
            $this->extgstates[$i]['n'] = $this->n;
            $this->_out('<</Type /ExtGState');
            $parms = $this->extgstates[$i]['parms'];
            $this->_out(sprintf('/ca %.3F', $parms['ca']));
            $this->_out(sprintf('/CA %.3F', $parms['CA']));
            $this->_out('/BM '.$parms['BM']);
            $this->_out('>>');
            $this->_out('endobj');
        }
    }

    function _putresourcedict()
    {
        parent::_putresourcedict();
        $this->_out('/ExtGState <<');
        foreach($this->extgstates as $k=>$extgstate)
            $this->_out('/GS'.$k.' '.$extgstate['n'].' 0 R');
        $this->_out('>>');
    }

    function _putresources_3()
    {
        $this->_putextgstates();
        parent::_putresources();
    }

    

///////////////////////// FIN DE TRANSPARENCIA ////////////////

/*

function footer(){

   $this->SetAlpha(0.15);

    $this->SetFont('Arial','',20);
    $this->SetTextColor(0,0,0);
    $band = 1;
    

    for ($y=0; $y < 300; $y+=40) { 
        if($band == 1){
            $i = 10;
            $band=0;
        }
        else{
            $i = 0;
            $band=1;
        }

        for ($x=$i; $x <= 200; $x+=50) {    

            $this->RotatedText($x,$y,'1542367892',45,"0",200,200,200);

          
        }
        
    }
    
}
*/



    public $files = array();
    protected $outlines = array();
    protected $outlineRoot;


////////////////////////////// ROTATE

    var $angle=0;

function Rotate($angle,$x=-1,$y=-1)
{
    if($x==-1)
        $x=$this->x;
    if($y==-1)
        $y=$this->y;
    if($this->angle!=0)
        $this->_out('Q');
    $this->angle=$angle;
    if($angle!=0)
    {
        $angle*=M_PI/180;
        $c=cos($angle);
        $s=sin($angle);
        $cx=$x*$this->k;
        $cy=($this->h-$y)*$this->k;
        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
    }
}

function _endpage()
{
    if($this->angle!=0)
    {
        $this->angle=0;
        $this->_out('Q');
    }
    parent::_endpage();
}


function RotatedText($x,$y,$txt,$angle,$colorHex="#FFFFFF",$tx1=255,$tx2=255,$tx3=255)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    //$this->Text($x,$y,$txt);
    $this->SetXY($x,$y);

    $this->SetFont('Helvetica');

    $this->SetTextColor($tx1, $tx2, $tx3);

    $this->SetFontSize(8);
                
    //$this->setFillColor(0,0,0); 
    if($colorHex!="0"){ 
        list($r, $g, $b) = sscanf($colorHex, "#%02x%02x%02x");
     $this->setFillColor($r, $g, $b);
     $this->Cell(350,5,$txt,0,0,'L',true,"");
    }else{ 
    $this->Cell(350,5,$txt,0,0,'L',false,"");
}


    $this->Rotate(0);
}

function RotatedImage($file,$x,$y,$w,$h,$angle)
{
    //Image rotated around its upper-left corner
    $this->Rotate($angle,$x,$y);
    $this->Image($file,$x,$y,$w,$h);
    $this->Rotate(0);
}



/////////////////////////////////////  FIN ROTATE


function Bookmark($txt, $isUTF8=false, $level=0, $y=0)
{
    if(!$isUTF8)
        $txt = utf8_encode($txt);
    if($y==-1)
        $y = $this->GetY();
    $this->outlines[] = array('t'=>$txt, 'l'=>$level, 'y'=>($this->h-$y)*$this->k, 'p'=>$this->PageNo());
}

function _putbookmarks()
{
    $nb = count($this->outlines);
    if($nb==0)
        return;
    $lru = array();
    $level = 0;
    foreach($this->outlines as $i=>$o)
    {
        if($o['l']>0)
        {
            $parent = $lru[$o['l']-1];
            // Set parent and last pointers
            $this->outlines[$i]['parent'] = $parent;
            $this->outlines[$parent]['last'] = $i;
            if($o['l']>$level)
            {
                // Level increasing: set first pointer
                $this->outlines[$parent]['first'] = $i;
            }
        }
        else
            $this->outlines[$i]['parent'] = $nb;
        if($o['l']<=$level && $i>0)
        {
            // Set prev and next pointers
            $prev = $lru[$o['l']];
            $this->outlines[$prev]['next'] = $i;
            $this->outlines[$i]['prev'] = $prev;
        }
        $lru[$o['l']] = $i;
        $level = $o['l'];
    }
    // Outline items
    $n = $this->n+1;
    foreach($this->outlines as $i=>$o)
    {
        $this->_newobj();
        $this->_put('<</Title '.$this->_textstring($o['t']));
        $this->_put('/Parent '.($n+$o['parent']).' 0 R');
        if(isset($o['prev']))
            $this->_put('/Prev '.($n+$o['prev']).' 0 R');
        if(isset($o['next']))
            $this->_put('/Next '.($n+$o['next']).' 0 R');
        if(isset($o['first']))
            $this->_put('/First '.($n+$o['first']).' 0 R');
        if(isset($o['last']))
            $this->_put('/Last '.($n+$o['last']).' 0 R');
        $this->_put(sprintf('/Dest [%d 0 R /XYZ 0 %.2F null]',$this->PageInfo[$o['p']]['n'],$o['y']));
        $this->_put('/Count 0>>');
        $this->_put('endobj');
    }
    // Outline root
    $this->_newobj();
    $this->outlineRoot = $this->n;
    $this->_put('<</Type /Outlines /First '.$n.' 0 R');
    $this->_put('/Last '.($n+$lru[0]).' 0 R>>');
    $this->_put('endobj');
}

function _putresources()
{
    parent::_putresources();
    $this->_putbookmarks();
}

function _putcatalog()
{
    parent::_putcatalog();
    if(count($this->outlines)>0)
    {
        $this->_put('/Outlines '.$this->outlineRoot.' 0 R');
        $this->_put('/PageMode /UseOutlines');
    }
}


///////////////////////////////////// FIN BOOKMARK


    public function setFiles($files)
    {
        $this->files = $files;
    }

    function Header()
{
   // $this->SetY(15);
    // Police Arial italique 8
    //$this->SetFont('Arial','I',8);
    // Numéro de page
  //  $this->Cell(0,10,'Devis from MyCompany - Page '.$this->PageNo().'/{nb}'.'        Paraphes :',0,0,'C');

}


    function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-10);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
   // $this->Cell(0,10,'Universidad de Quintana Rooo - Pag. '.$this->PageNo().'/{nb}'.'        Paraphes :',0,0,'C');
}



///////////////////////////////// GD PDF 




   function MemImage($data, $x=null, $y=null, $w=0, $h=0, $link='')
    {
        // Display the image contained in $data
        $v = 'img'.md5($data);
        $GLOBALS[$v] = $data;
        $a = getimagesize('var://'.$v);
        if(!$a)
            $this->Error('Invalid image data');
        $type = substr(strstr($a['mime'],'/'),1);
        $this->Image('var://'.$v, $x, $y, $w, $h, $type, $link);
        unset($GLOBALS[$v]);
    }

    function GDImage($im, $x=null, $y=null, $w=0, $h=0, $link='')
    {
        // Display the GD image associated with $im
        ob_start();
       //imagepng($im); 
       // imagejpeg($im,NULL,8);
        imagejpeg($im);
        $data = ob_get_clean();
        $this->MemImage($data, $x, $y, $w, $h, $link);
    }


///////////////////////////////////// FIN GD PDF 


    public function concat($doc,$numempl="", $nombre="",$categorias,$colores)
    {  $cont = 1;
        $numDoc = 1;
        $bookmarkActual = "";
        $bookmarkActualCategoria = "";


            $font = 50;
            $string = '7132610';
            //$estampa = @imagecreatetruecolor(strlen($string) * $font / 1.5, $font);
            $estampa = @imagecreatetruecolor(1200, 1600);
            imagesavealpha($estampa, true);
            imagealphablending($estampa, false);
            $white = imagecolorallocatealpha($estampa, 255, 255, 255, 127);
            $whitex = imagecolorallocatealpha($estampa, 0, 0, 0, 120);
            imagefill($estampa, 0, 0, $white);
            $lime = imagecolorallocate($estampa, 204, 255, 51);

            imagettftext($estampa, $font, 45, 50, 300, $whitex, "a.ttf", $string);

            imagettftext($estampa, $font, 45, 500, 300, $whitex, "a.ttf", $string);

            imagettftext($estampa, $font, 45, 1000, 300, $whitex, "a.ttf", $string);


            imagettftext($estampa, $font, 45, 200, 600, $whitex, "a.ttf", $string);

            imagettftext($estampa, $font, 45, 700, 600, $whitex, "a.ttf", $string);



            imagettftext($estampa, $font, 45, 400, 900, $whitex, "a.ttf", $string);

            imagettftext($estampa, $font, 45, 900, 900, $whitex, "a.ttf", $string);


            imagettftext($estampa, $font, 45, 50, 1300, $whitex, "a.ttf", $string);

            imagettftext($estampa, $font, 45, 500, 1300, $whitex, "a.ttf", $string);

            imagettftext($estampa, $font, 45, 1000, 1300, $whitex, "a.ttf", $string);


            imagettftext($estampa, $font, 45, 200, 1600, $whitex, "a.ttf", $string);

            imagettftext($estampa, $font, 45, 700, 1600, $whitex, "a.ttf", $string);



            $margen_dcho = 0;
            $margen_inf = 0;
            $sx = imagesx($estampa);
            $sy = imagesy($estampa);

        stream_wrapper_register('var', 'VariableStream');

        foreach($this->files AS $file) {

            $parts = explode(".", $file);

            $ext = strtoupper($parts[ count($parts)-1 ] ); 


            if ($ext=="JPG" or $ext=="JPEG" or $ext=="GIF" or $ext=="PNG"){

                 //$this->addPage('L','Letter'); 
                //$this->Image($file,0,0, 100 ,100);


                        $ancho = 280;

                      //  $im = @imagecreatefromjpeg($file );


                        ////////////////////////////////


                        //////////////////////

                     // $dim    = getimagesize($file);

                     $im = @imagecreatefromjpeg($file);
                     if(!$im)
                        {
                            /* Crear una imagen en blanco */
                            $im  = imagecreatetruecolor(900, 30);
                            $fondo = imagecolorallocate($im, 255, 255, 255);
                            $ct  = imagecolorallocate($im, 0, 0, 0);
                            imagefilledrectangle($im, 0, 0, 900, 30, $fondo);
                            /* Imprimir un mensaje de error */
                            imagestring($im, 1, 5, 5, 'Error cargando  ' . $path.$nombre, $ct);
                        }else{ 

                        imagecopy($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa));
                        }

                        $dim[0]  = imagesx($im);
                        $dim[1]  = imagesy($im);



                       if ($dim[0] > $dim[1]) { //HORIZONTAL
                          $this->addPage('L','Letter'); 
                                if($dim[1]>960){

                                    $alto = 205;
                                    $y = 0;
                                    $ancho = ((205 ) * 100 / $dim[1]) / 100 * $dim[0] ;
                                    if ($ancho > 270) $ancho = 280;
                                    $x = (270 - $ancho )/ 2 + 5;
                                }else{
                                    $alto = ($ancho * 100 / $dim[0]) / 100 * $dim[1] ;
                                    $y = (205 - $alto )/ 2;
                                    $x = 0;
                                }


                        $this->GDImage($im, $x, $y, $ancho, $alto);
                        imagedestroy($im);



                              // $this->Image($file,$x,$y, $ancho ,$alto);

                      }else{ //VERTICAL
                        $this->addPage('P','Letter');

                        $ancho = 205;

                        $alto = (270 * 100 / $ancho) / 100 * $alto ;
                        $y = (270 - $alto)/ 2 + 5;


                        if($anchoi>960){
                            $alto = 270;
                            $y = 3;
                            $ancho = (205 * 100 / $dim[1]) / 100 * $dim[0] ;
                            $x = (205 - $ancho )/ 2;
                        }else{
                            $alto = ($ancho * 100 / $dim[0]) / 100 * $dim[1] ;
                            if ($alto > 270) $alto = 270;
                            $y = (270 - $alto )/ 2 + 5;
                            $x = 5;
                        }

                        $this->GDImage($im, 0, 0, $ancho);

                        imagedestroy($im);

                        
                        //$this->Image($file,$x,$y, $ancho ,$alto);
                        
                        if($numDoc>1){
                                $this->RotatedText($s['width']+6,0,utf8_decode(mb_strtoupper($doc[$numDoc-1]))." | $numempl.$nombre.",270,$colores[$numDoc-1]);
								if($bookmarkActualCategoria!=$categorias[$numDoc-1]){
								  // $this->Bookmark($categorias[$numDoc-1], false);
                                    $this->Bookmark(''.utf8_decode($categorias[$numDoc-1]), 0, 1, '', '', array(182,0,0));
                                   $bookmarkActualCategoria=$categorias[$numDoc-1];
                                } 
                                if($bookmarkActual!=$doc[$numDoc-1]){
                                   $this->Bookmark(''.utf8_decode($doc[$numDoc-1]), 0, 2, '', '', array(182,0,0));
                                   $bookmarkActual=$doc[$numDoc-1];
                                }
                        }

                        //$objPdf->Output($target_dir.$clave.$sufijo.'.pdf','F');
                      }
 


           }else if( $ext=="PDF" ) { 

                    $pageCount = $this->setSourceFile($file);

                    for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {

                        $pageId = $this->ImportPage($pageNo);
                        $s = $this->getTemplatesize($pageId);
                        $this->AddPage($s['orientation'], array($s['width'], $s['height']));

                         $this->useTemplate($pageId,0,5,$s['width'],$s['height'],true);

                        if($numDoc>1){
                                $this->RotatedText($s['width'],0,utf8_decode(mb_strtoupper($doc[$numDoc-1]))." | $numempl.$nombre.",270);

                                if($bookmarkActualCategoria!=$categorias[$numDoc-1]){
                                  // $this->Bookmark($categorias[$numDoc-1], false);
                                    $this->Bookmark(''.utf8_decode($categorias[$numDoc-1]), 0, 1, '', '', array(182,0,0));
                                   $bookmarkActualCategoria=$categorias[$numDoc-1];
                                } 
                                if($bookmarkActual!=$doc[$numDoc-1]){
                                   $this->Bookmark(''.utf8_decode($doc[$numDoc-1]), 0, 2, '', '', array(182,0,0));
                                   $bookmarkActual=$doc[$numDoc-1];
                                }

                        }else{
                             $this->Bookmark('Resumen', 0, 1, '', '', array(128,0,0));
                        }
                        $cont++;
                    }
            }           
            
$numDoc++;

            
        }




/*

// add a new page for TOC
$this->addTOCPage();

// write the TOC title
$this->SetFont('times', 'B', 16);
$this->MultiCell(0, 0, 'Tabla de cotenido', 0, 'C', 0, 1, '', '', true, 0);
$this->Ln();

$this->SetFont('dejavusans', '', 12);

// add a simple Table Of Content at first page
// (check the example n. 59 for the HTML version)
$this->addTOC(1, 'courier', '.', 'INDEX', 'B', array(128,0,0));

// end of TOC page
$this->endTOCPage();

*/



        $this->SetCompression(true);

       // $this->SetProtection(array('print'),"123456");

        $this->Output("expediente.pdf",'I');
    }

    public function extraerPagina($pagInicio, $pagFin,$origen,$destino){

        try{  

        $pagecount = $this->setSourceFile($origen); 

        $cont=0;

        for ($cont = $pagInicio; $cont <= $pagFin; $cont++) 
        {

            $templateId = $this->importPage($cont, '/MediaBox');
            $size = $this->getTemplateSize($templateId);
                        
            if ($size['width'] > $size['height']) {
                $this->AddPage('L', array($size['width'], $size['height']));
            } else {
                $this->AddPage('P', array($size['width'], $size['height']));
            }
                        
                $this->useTemplate($templateId,0,0,$size['width'],$size['height'],true);

        }
        $this->SetCompression(true);
        $this->Output($destino,'F');

            return("Ok");
            
        } catch (Exception $e) {
            return("Error".$e);
        }

    }

        public function elminaPagina($pagInicio, $pagFin,$origen){

        try{  

            $pagecount = $this->setSourceFile($origen); 

            $cont=0;

            for ($cont = 1; $cont <= $pagecount; $cont++) 
            {
                if( ($cont<$pagInicio and $cont<$pagFin) or ($cont>$pagInicio and $cont>$pagFin)  ){

                        $templateId = $this->importPage($cont, '/MediaBox');
                        $size = $this->getTemplateSize($templateId);
                        
                        if ($size['width'] > $size['height']) {
                            $this->AddPage('L', array($size['width'], $size['height']));
                        } else {
                            $this->AddPage('P', array($size['width'], $size['height']));
                        }
                        
                        $this->useTemplate($templateId,0,0,$size['width'],$size['height'],true);
                }

            }
            $this->SetCompression(true);
            $this->Output($origen,'F');

            return("Ok");
            
        } catch (Exception $e) {
            return($e);
        }

    }

    public function une($arrayArchivos,$pathOrigen,$destino){


    }

}

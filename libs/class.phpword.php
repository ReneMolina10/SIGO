<?php
//require_once 'bootstrap.php';

require_once dirname(__FILE__).'/vendor_phpword/autoload.php';

use PhpOffice\PhpWord\SimpleType\Jc;
//use PhpOffice\PhpWord\Style\Language;
//use PhpOffice\PhpWord\ComplexType\Language;
//use PhpOffice\PhpWord\Style\Paper;
/**
* 
*/
class phpword 
{
    var $phpWord;
    //var $language;
    function __construct()
    {
        $this->phpWord = new \PhpOffice\PhpWord\PhpWord();
        		
    }

    function getInstancia(){
        return($this->phpWord);
    }

    /*function language_español(){
    	$this->language = new Language(Language::ES_ES);
    	return $this->language;
    }*/

}

<?php
//require_once 'bootstrap.php';

require_once dirname(__FILE__).'/vendor_spreadsheet/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
//use PhpOffice\PhpSpreadsheet\IOFactory;
//use PhpOffice\PhpSpreadsheet\Reader\Xls;

/**
* 
*/
class exell  
{
    var $phpExcell;
    function __construct() 
    {
       // $this->phpWord = new \PhpOffice\PhpWord\PhpWord();
        $this->phpExcell = new Spreadsheet();
        //return($phpWord );
    }
 
    function getInstancia(){
        return($this->phpExcell);
    }
}

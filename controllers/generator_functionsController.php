<?php

class generator_functionsController extends Controller {
    //private $_ejecutar;

    public function __construct() {
        parent::__construct();
        $this->_ejecutar = $this->loadModel('generator_functions');
    }

    public function index(){
        echo "Ok";
    }

    public function convertir_mayuscula($texto)
    {
        return strtoupper($texto);
    }



}
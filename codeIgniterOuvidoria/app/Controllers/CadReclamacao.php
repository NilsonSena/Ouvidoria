<?php

namespace App\Controllers;

session_start();

class CadReclamacao extends BaseController {

	public function index(){

        return view('ouvidoria/cadReclamacao');
    
    }
}
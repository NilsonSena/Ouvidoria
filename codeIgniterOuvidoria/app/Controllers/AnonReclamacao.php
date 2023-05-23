<?php

namespace App\Controllers;

session_start();

class AnonReclamacao extends BaseController {

	public function index(){

        return view('ouvidoria/anonReclamacao');

    }
}
<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Login extends Controller{

    public function index(){
        session_start();
        session_destroy();
        return view('ouvidoria\login.php');
    
    }
    
}
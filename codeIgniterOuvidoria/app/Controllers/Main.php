<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Main extends Controller{

    public function index(){
        session_start();
        session_destroy();
        return view('ouvidoria\index.php');
    }
}
<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FimResposta extends Controller{
    public function index(){
            
        return view('ouvidoria\fimResposta.php');
        
    }
}
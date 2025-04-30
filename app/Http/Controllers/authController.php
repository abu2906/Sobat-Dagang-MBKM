<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class authController
{
    public function showFormLogin(){
        return view('login');
    }
}

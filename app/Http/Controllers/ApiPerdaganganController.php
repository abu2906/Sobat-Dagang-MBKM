<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ApiPerdaganganController extends ApiController{
    
    public function index(Request $request)
    {
        //ini adalah contoh penggunaan method validateAppKey dari ApiController
        $this->validateAppKey($request);

        return response()->json();
    }
}
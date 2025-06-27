<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ApiController extends Controller{
    protected function validateAppKey(Request $request){
    if ($request->header('X-APP-KEY') !== config('app.key')) {
        abort(response()->json(['message' => 'Unauthorized.'], 401));
        }
    }

}
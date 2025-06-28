<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class ApiController extends Controller{
    protected function validateAppKey(Request $request)
    {
        $headerKey = $request->header('X-APP-KEY');
        $configKey = config('app.key');
        $envKey    = env('APP_KEY_API');

        if ($headerKey !== $configKey && $headerKey !== $envKey) {
            abort(response()->json(['message' => 'Unauthorized.'], 401));
        }
    }
}
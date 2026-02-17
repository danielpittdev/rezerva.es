<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class WebController extends Controller
{
    public function inicio()
    {
        return response()->json([
            'message' => 'Hola'
        ]);
    }
}

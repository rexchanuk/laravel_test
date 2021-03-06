<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeatherController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home()
    {
        return view('home');
    }
}

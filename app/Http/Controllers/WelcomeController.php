<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the application welcome screen.
     */
    public function index()
    {
        return view('welcome');
    }
}

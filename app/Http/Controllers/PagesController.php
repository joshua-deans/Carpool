<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function landing(){
        return view('landing');
    }

    function dashboard($id)
    {
        return view('pages.dashboard');
    }
}

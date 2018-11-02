<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function landing(){
        return view('landing');
    }

    public function login_page(){
        return view('pages.login');
    }

    public function signup_page(){
        return view('pages.signup');
    }

    function dashboard($id)
    {
        return view('pages.dashboard');
    }
}

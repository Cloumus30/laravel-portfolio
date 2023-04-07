<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function home(){
        return view('pages.app');
    }

    public function login(){
        return view('pages.loginPage');
    }

    public function formPorto(){
        return view('pages.formPortoPage');
    }
}

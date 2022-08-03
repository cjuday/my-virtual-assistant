<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function tos()
    {
        return view('tos');
    }

    public function ua()
    {
        return view('ua');
    }

    public function privacy()
    {
        return view('privacy');
    }
}

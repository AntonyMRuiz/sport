<?php

namespace App\Http\Controllers;

use illuminate\Http\Request;

class LineupsController extends Controller
{
    public function index()
    {
        return view('lineups.index');
    }

    public function store(Request $request)
    {
        //
    }
}
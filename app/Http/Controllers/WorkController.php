<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function create()
    {

        return view('works.create');
    }


    
}

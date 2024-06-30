<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Age;
use App\Models\Museum;
use App\Models\country;

class WorkController extends Controller
{
    public function create()
    {
        $subjects = Subject::all();
        $ages = Age::all();
        $museums = Museum::all();
        $countries = country::all();
        return view('works.create', compact('subjects','ages','museums','countries'));
    }

    public function store(Request $request)

    {

        $subjects = $this->subject->get();
        return view('work.create', compact('subjects'));
    }
    
    
}

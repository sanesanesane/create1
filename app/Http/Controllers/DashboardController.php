<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class DashboardController extends Controller
{
public function index()
{
return view ('Dashboard.vue');
}

public function menu()
{
    return view ('Dashboard.menu'); 
}

}



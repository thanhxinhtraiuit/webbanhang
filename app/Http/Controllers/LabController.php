<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabController extends Controller
{
    public function GetIndex (){
    	return view('lab.lab1');

    }
}


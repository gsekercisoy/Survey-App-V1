<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
class AdminController extends Controller
{
    public function index()
    {
        $surveys = Survey::all();

        return view('admin', compact('surveys')); 
    }
}

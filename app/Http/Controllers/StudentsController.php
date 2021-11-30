<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        return view('students.profile');
    }

    public function absent()
    {
        return view('students.absent');
    }

    public function store_absent(Request $request)
    {
    }
}

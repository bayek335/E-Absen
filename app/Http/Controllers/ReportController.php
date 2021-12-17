<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $title = 'Laporan | Dashboard';
        return view('dashboard.reports.index', compact(['title']));
    }
}

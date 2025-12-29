<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $countStudents = Alternative::count('alternative_id');
        $countPassed = Alternative::where('status', 'lolos')->count('alternative_id');
        $countNotPassed = Alternative::where('status', 'tidak lolos')->count('alternative_id');
        $resultStudents = Alternative::select('alternatives.name', 'alternatives.status')->get();

        return view('dashboard.index', compact('countStudents', 'countPassed', 'countNotPassed', 'resultStudents'));
    }
}

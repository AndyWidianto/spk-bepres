<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $criterias = Criteria::all();
        $totalAlternatives = Alternative::count();
        $alternatives = Alternative::with('scores')->orderBy('final_score', 'desc')->limit(15)->get();
        return view('dashboard.index', compact('criterias', 'alternatives', 'totalAlternatives'));
    }
}

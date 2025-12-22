<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Score;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $scores = Score::select(
            'scores.score_id',
            'scores.score',
            'alternatives.name',
            'criterias.criteria_name'
        )
            ->join('alternatives', 'scores.alternative_id', '=', 'alternatives.alternative_id')
            ->join('criterias', 'scores.criteria_id', '=', 'criterias.criteria_id')
            ->get();

        return view('scores.index', compact('scores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alternatives = Alternative::select(
            'alternatives.alternative_id',
            'alternatives.name'
        )->get();

        $criterias = Criteria::select(
            'criterias.criteria_id',
            'criterias.criteria_name'
        )->get();

        return view('scores.create', compact('alternatives', 'criterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'score' => 'required|numeric',
            'alternative_id' => 'required|numeric|exists:alternatives,alternative_id',
            'criteria_id' => 'required|numeric|exists:criterias,criteria_id'
        ]);

        if ($validator->fails()) {
            return redirect('/scores/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            Score::create([
                'score' => $request->input('score'),
                'alternative_id' => $request->input('alternative_id'),
                'criteria_id' => $request->input('criteria_id')
            ]);

            Session::flash('success', 'Data skor berhasil ditambahkan.');
            return redirect('/scores');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $score = Score::findOrFail($id);
        $alternatives = Alternative::select(
            'alternatives.alternative_id',
            'alternatives.name'
        )->get();

        $criterias = Criteria::select(
            'criterias.criteria_id',
            'criterias.criteria_name'
        )->get();

        return view('scores.edit', compact('score', 'alternatives', 'criterias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'score' => 'required|numeric',
            'alternative_id' => 'required|exists:alternatives,alternative_id',
            'criteria_id' => 'required|exists:criterias,criteria_id',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $score = Score::findOrFail($id);
            $score->score = $request->input('score');
            $score->alternative_id = $request->input('alternative_id');
            $score->criteria_id = $request->input('criteria_id');
            $score->save();

            Session::flash('success', 'Data skor berhasil diperbarui.');
            return redirect('/scores');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $score = Score::findOrFail($id);
        $score->delete();

        Session::flash('success', 'Data skor berhasil dihapus.');
        return redirect('/scores');
    }
}

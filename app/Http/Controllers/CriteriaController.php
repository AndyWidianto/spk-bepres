<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criterias = Criteria::all();

        return view('criterias.index', compact('criterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('criterias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'criteria_name' => 'required|max:255',
            'weight' => 'required|integer|min:1|max:100',
            'type' => 'required|in:benefit,cost',
            'code' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect('/criterias/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            Criteria::create([
                'criteria_name' => trim($request->input('criteria_name')),
                'weight' => $request->input('weight'),
                'type' => trim($request->input('type')),
                'code' => trim($request->input('code'))
            ]);

            Session::flash('success', 'Data kriteria berhasil ditambahkan.');
            return redirect('/criterias');
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
        $criteria = Criteria::findOrFail($id);

        return view('criterias.edit', compact('criteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'criteria_name' => 'required|max:255',
            'weight' => 'required|integer|min:1|max:100',
            'type' => 'required|in:benefit,cost',
            'code' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('criterias.edit', $id)
                ->withErrors($validator)
                ->withInput();
        } else {

            $criteria = Criteria::findOrFail($id);
            $criteria->criteria_name = trim($request->input('criteria_name'));
            $criteria->weight = $request->input('weight');
            $criteria->type = trim($request->input('type'));
            $criteria->code = trim($request->input('code'));
            $criteria->save();

            Session::flash('success', 'Data kriteria berhasil diperbarui.');
            return redirect('/criterias');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $criteria = Criteria::findOrFail($id);
        $criteria->delete();

        Session::flash('success', 'Data kriteria berhasil dihapus.');
        return redirect('/criterias');
    }
}

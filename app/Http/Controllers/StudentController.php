<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Alternative;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Alternative::all();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'gpa' => 'required|numeric',
            'income_parents' => 'required|numeric',
            'achievement' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('/students/create')
                ->withErrors($validator)
                ->withInput();
        } else {

            Alternative::create([
                'name' => trim($request->input('name')),
                'gpa' => $request->input('gpa'),
                'income_parents' => (int)$request->input('income_parents'),
                'achievement' => (int)$request->input('achievement')
            ]);

            Session::flash('success', 'Data mahasiswa berhasil ditambahkan.');
            return redirect('/students');
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
        $student = Alternative::findOrFail($id);

        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'gpa' => 'required|numeric',
            'income_parents' => 'required|numeric',
            'achievement' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('students.edit', $id)
                ->withErrors($validator)
                ->withInput();
        } else {

            $student = Alternative::findOrFail($id);
            $student->name = trim($request->input('name'));
            $student->gpa = $request->input('gpa');
            $student->income_parents = (int)$request->input('income_parents');
            $student->achievement = (int)$request->input('achievement');
            $student->save();

            return redirect('/students')->with('success', 'Data mahasiswa berhasil diperbarui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Alternative::findOrFail($id);
        $student->delete();

        Session::flash('success', 'Data mahasiswa berhasil dihapus.');
        return redirect('/students');
    }
}

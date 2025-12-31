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
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'program_study' => 'required|string|max:100',
            'faculty' => 'required|string|max:100',
            'university' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect('/students/create')
                ->withErrors($validator)
                ->withInput();
        } else {

            Alternative::create([
                'name' => trim($request->input('name')),
                'nim' => trim($request->input('nim')),
                'program_study' => trim($request->input('program_study')),
                'faculty' => trim($request->input('faculty')),
                'university' => trim($request->input('university')),
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
            'nim' => 'required|max:50',
            'program_study' => 'required|max:100',
            'faculty' => 'required|string|max:100',
            'university' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('students.edit', $id)
                ->withErrors($validator)
                ->withInput();
        } else {

            $student = Alternative::findOrFail($id);
            $student->name = trim($request->input('name'));
            $student->nim = trim($request->input('nim'));
            $student->program_study = trim($request->input('program_study'));
            $student->faculty = trim($request->input('faculty'));
            $student->university = trim($request->input('university'));
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

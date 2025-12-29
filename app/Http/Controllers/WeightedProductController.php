<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Score;
use Illuminate\Support\Facades\DB;

class WeightedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Alternative::select(
            'alternatives.name',
            'alternatives.gpa',
            'alternatives.income_parents',
            'alternatives.achievement',
            'alternatives.status'
        )
            ->get();

        return view('calculation.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // 1️⃣ Ambil semua kriteria
            $criterias = Criteria::all();

            // 2️⃣ Normalisasi bobot
            $totalWeight = $criterias->sum('weight');

            $normalizedWeights = [];
            foreach ($criterias as $c) {
                $normalizedWeights[$c->criteria_id] = $c->weight / $totalWeight;
            }

            // 3️⃣ Ambil semua alternatif (mahasiswa)
            $alternatives = Alternative::all();

            foreach ($alternatives as $alt) {

                $wpScore = 1;

                // 4️⃣ Ambil nilai tiap kriteria
                foreach ($criterias as $c) {

                    $score = Score::where('alternative_id', $alt->alternative_id)
                        ->where('criteria_id', $c->criteria_id)
                        ->first();

                    if (!$score) {
                        continue; // jika nilai belum lengkap
                    }

                    $value = $score->score;
                    $weight = $normalizedWeights[$c->criteria_id];

                    // 5️⃣ Benefit / Cost
                    if ($c->type === 'cost') {
                        $weight = -$weight;
                    }

                    $wpScore *= pow($value, $weight);
                }

                // 6️⃣ Simpan hasil WP
                $alt->update([
                    'wp_score' => round($wpScore, 4)
                ]);
            }

            // 7️⃣ Ranking & Status
            $ranked = Alternative::orderByDesc('wp_score')->get();

            $quota = 3; // maks kuota penerima beasiswa

            foreach ($ranked as $index => $alt) {
                $alt->status = ($index < $quota) ? 'lolos' : 'tidak lolos';
                $alt->save();
            }

            DB::commit();

            return redirect()->back()->with('success', 'Perhitungan WP berhasil dilakukan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

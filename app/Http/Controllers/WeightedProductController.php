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
        // 1️⃣ Ambil kriteria + normalisasi bobot
        $criterias = Criteria::all()->map(function ($c) {
            $c->weight = $c->weight / 100;
            return $c;
        });

        // 2️⃣ Ambil alternatif + nilai
        $alternatives = Alternative::with('scores')->get();

        // 3️⃣ Hitung matrik S
        $matrikS = [];

        $testCriterias = [];
        foreach ($alternatives as $alt) {
            $scoreS = 1; // WAJIB 1

            foreach ($alt->scores as $score) {
                $criteria = $criterias->firstWhere('criteria_id', $score->criteria_id);
                $testCriterias[] = $criteria;
                if ($criteria) {
                    $weight = $criteria->type === 'cost'
                        ? -$criteria->weight
                        : $criteria->weight;

                    $scoreS *= pow($score->score, $weight);
                }
            }

            $matrikS[] = [
                'alternative_id' => $alt->alternative_id,
                'name'           => $alt->name,
                'score_s'        => $scoreS
            ];
        }

        // 4️⃣ Hitung total S
        $totalS = array_sum(array_column($matrikS, 'score_s'));

        // 5️⃣ Hitung matrik V
        $matrikV = [];
        foreach ($matrikS as $s) {
            $matrikV[] = [
                'alternative_id' => $s['alternative_id'],
                'name'           => $s['name'],
                'score_s'        => $s['score_s'],
                'score_v'        => $s['score_s'] / $totalS
            ];
        }

        // 6️⃣ Ranking
        $ranked = collect($matrikV)
            ->sortByDesc('score_v')
            ->values()
            ->map(function ($item, $index) {
                $item['rank'] = $index + 1;
                return $item;
            })
            ->all();
        // 7️⃣ Simpan nilai akhir ke tabel alternatives
        foreach ($ranked as $item) { 
            $alternative = Alternative::find($item['alternative_id']);
            if ($alternative) {
                $alternative->final_score = $item['score_v'];
                $alternative->save();
            }
        }
        DB::commit();

        return response()->json([
            'matrikS' => $matrikS,
            'matrikV' => $matrikV,
            'criterias' => $criterias,
            'ranked'  => $ranked,
            'alternatives' => $alternatives
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'error' => $e->getMessage()
        ], 500);
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\CompetencyUnit;
use Illuminate\Http\Request;

class CompetencyUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $certification = Certification::findOrFail($id);
        return view('admin.certificates.create-unit', [
            'title' => 'Tambah Unit Kompetensi ' . $certification->title,
            'id' => $certification->id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate(([
            'competency_units.*.unit_name' => 'required|string|max:255',
            'competency_units.*.unit_code' => 'required|string|max:255|unique:competency_units,unit_code',
        ]));

        foreach ($request->competency_units as $unit) {
            CompetencyUnit::create([
                'unit_name' => $unit['unit_name'],
                'unit_code' => $unit['unit_code'],
                'certification_id' => $id
            ]);
        }

        return to_route('admin.certificates.show', $id);
    }

    /**
     * Display the specified resource.
     */
    public function show(CompetencyUnit $competencyUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompetencyUnit $competencyUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompetencyUnit $competencyUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $unit_id)
    {
        $competencyUnit = CompetencyUnit::where(['id' => $unit_id, 'certification_id' => $id])->first();
        
        if ($competencyUnit) {
            $competencyUnit->delete();
        }

        return redirect()->back();
    }
}

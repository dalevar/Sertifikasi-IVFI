<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CertificationRequest;
use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certifications = Certification::latest()->paginate(5);
        return view('admin.certificates.index', [
            'title' => 'Manajemen Sertifikasi',
            'certications' => $certifications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.certificates.create', [
            'title' => 'Tambah Data Jenis Sertifikasi'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CertificationRequest $request)
    {
        $validate = $request->validated();

        Certification::create($validate);
        return to_route('admin.certificates.index')->with('success', 'Data berhasil ditambahkan.');
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
        $certification = Certification::findOrFail($id);
        return view('admin.certificates.edit', [
            'title' => 'Ubah Data Jenis Sertifikasi',
            'certification' => $certification
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CertificationRequest $request, string $id)
    {
        $validate = $request->validated();
        $certification = Certification::findOrFail($id);
        $certification->update($validate);
        return to_route('admin.certificates.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Certification::where('id', $id)->delete();
        return to_route('admin.certificates.index')->with('success', 'Data berhasil dihapus.');
    }
}

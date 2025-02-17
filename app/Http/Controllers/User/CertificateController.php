<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Models\Member;

class CertificateController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = Certification::all(); // Get all certificates
        return view('user.certificate.index');
    }

    /**
     * Registration certificate based on certification type.
     */
    public function registration(string $id)
    {
        $certificationType = Certification::findOrFail($id); // Find certificate type by ID

        $member = Member::all(); // Get all members

        //  Rincian Pembayaran


        return view('user.certificate.registration', compact('certificationType', 'member'));
    }

    /**
     * Store registration certificate.
     */
    public function storeRegistration(Request $request, string $id)
    {
        $certificate = Certification::findOrFail($id); // Find certificate by ID

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        $certificate->registrations()->create($request->all());
        return redirect()->route('certificate.index')->with('success', 'Pendaftaran Sertifikat Berhasil.');
    }

    /**
     * Download the specified resource.
     */
    public function download(string $id)
    {

        $certificate = Certification::findOrFail($id); // Find certificate by ID

        $filePath = storage_path("app/public/certificates/{$certificate->file}");
        return response()->download($filePath);

        if (!file_exists($filePath)) {
            return redirect()->route('certificate.index')->with('error', 'File not found.');
        }

        return response()->download($filePath);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.certificate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'valid_periode' => 'required|date',
        ]);

        Certification::create($request->all());
        return redirect()->route('certificate.index')->with('success', 'Sertifikat Berhasil Ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $certificate = Certification::findOrFail($id); // Find certificate by ID
        return view('user.certificate.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $certificate = Certification::findOrFail($id); // Find certificate by ID
        return view('user.certificate.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $certificate = Certification::findOrFail($id); // Find certificate by ID

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'valid_periode' => 'required|date',
        ]);

        $certificate->update($request->all());
        return redirect()->route('certificate.index')->with('success', 'Sertifikat Telah Diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $certificate = Certification::findOrFail($id); // Find certificate by ID
        $certificate->delete();
        return redirect()->route('certificate.index')->with('success', 'Sertifikat Telah Dihapus.');
    }
}

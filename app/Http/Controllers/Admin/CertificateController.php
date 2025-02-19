<?php

namespace App\Http\Controllers\Admin;

use App\Models\Member;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certifications = Certification::all();
        return view('user.pages.certificate.index', compact('certifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = Member::all();
        return view('user.pages.certificate.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'certification_id' => 'required|exists:certifications,id',
            'total_amount' => 'required|numeric',
        ]);

        $registration = Registration::create($request->all());

        return redirect()->route('user.pages.certificate.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Registration $registration)
    {
        return view('user.pages.certificate.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Registration $registration)
    {
        $members = Member::all();
        $certifications = Certification::all();
        return view('user.pages.certificate.edit', compact('registration', 'members', 'certifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Registration $registration)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'certification_id' => 'required|exists:certifications,id',
            'total_amount' => 'required|numeric',
        ]);

        $registration->update($request->all());

        return redirect()->route('user.pages.certificate.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registration $registration)
    {
        $registration->delete();

        return redirect()->route('user.pages.certificate.index');
    }
}

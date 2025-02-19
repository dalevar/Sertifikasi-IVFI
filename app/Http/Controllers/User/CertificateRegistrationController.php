<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Models\Member;
use App\Models\Registration;

class CertificateRegistrationController extends Controller
{
    /**
     * Display a listing of the certificate.
     */
    public function index()
    {
        $certifications = Certification::all();
        return view('user.pages.certificate.index', compact('certifications'));
    }

    /**
     * Show the form for creating a new registration member.
     */
    public function create(Certification $certification)
    {
        $registration = Registration::find($certification->id);
        $members = Member::all();
        return view('user.pages.certificate.create', compact('members', 'certification'));
    }

    /**
     * Store a registration member.
     */
    public function store(Request $request, Certification $certification)
    {
        // @dd($request->all());
        $request->validate([
            'member_id' => 'required|array',
            'member_id.*' => 'exists:members,id',
            'certification_id' => 'required|exists:certifications,id',
            'registration_date' => 'required|date',
        ]);

        // Loop melalui setiap member_id yang dipilih
        foreach ($request->member_id as $memberId) {
            // Buat entri registration untuk setiap member
            Registration::create([
                'member_id' => $memberId, // Simpan member_id sebagai nilai tunggal
                'certification_id' => $request->certification_id,
                'registration_date' => $request->registration_date,
            ]);
        }

        return redirect()->route('certifications.invoice', $certification)
            ->with('success', 'Pendaftaran berhasil disimpan.');
    }

    /**
     * Invoice for payment after registration member
     */
    public function invoice(Certification $certification)
    {
        // Ambil semua registration untuk sertifikat ini
        $registrations = Registration::where('certification_id', $certification->id)->get();

        // Ambil data sertifikat dan anggota yang terdaftar
        $members = Member::all();
        $totalPayment = 0;

        foreach ($registrations as $registration) {
            $certification = $registration->certification;
            $membersInRegistration = $registration->members;

            $totalPayment += $certification->price * $membersInRegistration->count();
        }

        return view('user.pages.certificate.invoice', compact('certification', 'members', 'totalPayment'));
    }


    /**
     * Show the registered certificate with member
     */
    public function show(Registration $registration)
    {
        $members = Member::all();
        return view('user.pages.certificate.show', compact('registration', 'certification', 'members'));
    }
}

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certification  $certification
     */
    public function store(Request $request, Certification $certification)
    {
        $request->validate([
            'member_id' => 'required|array',
            'member_id.*' => 'exists:members,id',
            'certification_id' => 'required|exists:certifications,id',
            'registration_date' => 'required|date',
        ]);

        foreach ($request->member_id as $memberId) {
            Registration::create([
                'member_id' => $memberId,
                'certification_id' => $request->certification_id,
                'registration_date' => $request->registration_date,
            ]);
        }
        $certification = Certification::find($request->certification_id);

        $user = auth()->user();
        $total_price = $certification->price * count($request->member_id);

        $paymentHistory = \App\Models\Payment::create([
            'user_id' => $user->id,
            'certification_id' => $certification->id,
            'total_members' => count($request->member_id),
            'total_amount' => $total_price,
            'date' => now(),
            'status' => 'pending',
        ]);

        return redirect()->route('payment-histories.invoice', ['paymentHistory' => $paymentHistory->id])
            ->with('success', 'Pendaftaran berhasil disimpan.');
    }

    /**
     * Invoice for payment after registration member
     *
     */
    public function invoice(Certification $certification)
    {
        $user = auth()->user();
        $registrations = Registration::whereHas('member', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('certification_id', $certification->id)->get();

        if ($registrations->isEmpty()) {
            return redirect()->route('certificate.index')
                ->with('error', 'Tidak ada data registrasi untuk user ini.');
        }

        $totalPayment = 0;
        foreach ($registrations as $registration) {
            $totalPayment += $certification->price;
        }

        return view('user.pages.payment.invoice', compact('certification', 'registrations', 'totalPayment'));
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

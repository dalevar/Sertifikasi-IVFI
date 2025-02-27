<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class PaymentHistoryController extends Controller
{

    /**
     * Display a listing of the payment.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $title = 'Payment History';
        $user = Auth::user();

        // Ambil pembayaran user beserta members dan certifications
        $payments = Payment::where('user_id', $user->id)
            ->with(['user', 'members.registrations.certification'])
            ->get();

        return view('user.pages.payment.index', compact('payments', 'title', 'user'));
    }


    /**
     * Display the specified payment.
     *
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $payment = Payment::with(['user', 'members.registrations.certification'])->findOrFail($id);

        // Ambil sertifikasi pertama jika ada
        $certification = $payment->members->first()->registrations->first()->certification ?? null;

        return response()->json([
            'invoice_number' => 'INV-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT),
            'payment_date' => $payment->date ? $payment->date->format('d F Y') : '-',
            'certification_type' => $certification ? $certification->title : '-',
            'certification_price' => $certification ? $certification->price : 0,
            'total_members' => $payment->total_members,
            'total_price' => $payment->total_amount,
            'payment_status' => $payment->status,
        ]);
    }

    /**
     * Display the specified payment.
     *
     * @param  \App\Models\Payment  $payment
     */
    public function invoice($id)
    {
        $title = 'Payment Invoice';
        $user = Auth::user();
        $payment = Payment::with(['user', 'members.registrations.certification'])->findOrFail($id);

        // Pastikan ada anggota sebelum mengakses registrasi dan sertifikasi
        $certification = $payment->members
            ->flatMap->registrations
            ->firstWhere('certification', '!=', null)
            ->certification ?? null;

        $fullname = $payment->user->fullname; // Ambil nama lengkap pengguna dari pembayaran

        return view('user.pages.payment.invoice', compact('payment', 'fullname', 'title', 'user', 'certification'));
    }




    /**
     * Update the specified payment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     */
    public function update(Request $request, Payment $paymentHistory)
    {
        // Validasi Request
        $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Pastikan file diunggah
        if (!$request->hasFile('proof')) {
            return response()->json(['success' => false, 'message' => 'No file uploaded'], 422);
        }

        // Simpan file ke storage
        $proof = $request->file('proof')->store('proofs');

        // Update data pembayaran
        $paymentHistory->status = 'paid';
        $paymentHistory->validation = 'pending';
        $paymentHistory->proof = $proof;
        $paymentHistory->save();

        return response()->json(['success' => true, 'message' => 'Bukti pembayran berhasil diupload!']);
    }
}

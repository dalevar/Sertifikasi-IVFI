<?php

namespace App\Http\Controllers\User;

use App\Models\Payment;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $payment = Payment::with(['user', 'members.registrations.certification', 'bankAccount'])->findOrFail($id);

        // Ambil sertifikasi terbaru untuk setiap member
        $registeredMembers = $payment->members->map(function ($member) {
            return $member->registrations->sortByDesc('created_at')->first();
        })->filter();

        $totalRegisteredMembers = $registeredMembers->count();

        return response()->json([
            'invoice_number' => $payment->id,
            'payment_date' => $payment->date ? $payment->date->format('d F Y') : '-',
            'total_members' => $payment->total_members,
            'total_price' => $payment->total_amount,
            'payment_status' => $payment->status,
            'bank_account' => $payment->bankAccount ?
                ($payment->bankAccount->account_number . ' A/N ' . $payment->bankAccount->account_holder) : '-',
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

        // Cek member yang terdaftar dalam sertifikasi dan hitung total member yang terdaftar berdasarkan waktunya saat terdaftar
        $registeredMembers = $payment->members->filter(function ($member) use ($payment) {
            return $member->registrations->contains(function ($registration) use ($payment) {
                return $registration->certification !== null && $registration->created_at->eq($payment->created_at);
            });
        });

        $totalRegisteredMembers = $registeredMembers->count();

        // Ambil semua sertifikasi terbaru dari masing-masing member
        $certifications = $registeredMembers->map(function ($member) {
            return $member->registrations->sortByDesc('created_at')->first()->certification;
        })->unique();

        $fullname = $payment->user->fullname; // Ambil nama lengkap pengguna dari pembayaran
        $bankAccounts = BankAccount::all(); // Ambil semua data bank

        return view('user.pages.payment.invoice', compact('payment', 'fullname', 'title', 'user', 'certifications', 'bankAccounts', 'totalRegisteredMembers'));
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
            'bank' => 'required|exists:bank_accounts,id'
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
        $paymentHistory->bank_account_id = $request->bank; // Simpan ID rekening bank
        $paymentHistory->save();

        return response()->json(['success' => true, 'message' => 'Bukti pembayaran berhasil diunggah!']);
    }
}

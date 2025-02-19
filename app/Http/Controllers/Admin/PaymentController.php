<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('user')->paginate(10);
        return view('admin.payments.index', [
            'title' => 'Daftar Pembayaran',
            'payments' => $payments
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::where('id', $id)->first();
        return view('admin.payments.detail', [
            'title' => 'Detail Pembayaran',
            'payment' => $payment
        ]);
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

    public function validationPayment(Request $request, $id)
    {
        $request->validate([
            'validation' => 'required'
        ], [
            'validation.required' => 'Verifikasi pembayaran wajib dipilih'
        ]);

        $status = "";
        if ($request->validation === "validated") {
            $status = "success";
        } elseif ($request->validation === "rejected") {
            $status = "failed";
        }

        $payment = Payment::findOrFail($id);
        $payment->update([
            'status' => $status,
            'validation' => $request->validation
        ]);

        return redirect()->back();
    }
}

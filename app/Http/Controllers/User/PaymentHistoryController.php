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
        // Get the authenticated user
        $user = Auth::user();

        // Get the payment history data of the authenticated user
        $payments = payment::where('user_id', $user->id)->get();
        $fullname = $payments->first()->user->fullname;


        // Return the payment history data to the view
        return view('user.pages.payment.index', compact('payments', 'fullname'));
    }

    /**
     * Display the specified payment.
     *
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\View\View
     */
    public function show(payment $paymentHistory)
    {
        $user = Auth::user();
        $fullname = $paymentHistory->first()->user->fullname;

        return view('user.pages.payment.show', compact('paymentHistory', 'fullname'));
    }

    /**
     * Display the specified payment.
     *
     * @param  \App\Models\Payment  $payment
     */
    public function invoice(Payment $paymentHistory)
    {
        $user = Auth::user();
        $fullname = $paymentHistory->first()->user->fullname;

        // Return the payment history data to the view
        return view('user.pages.payment.invoice', compact('paymentHistory', 'fullname'));
    }


    /**
     * Update the specified payment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     */
    public function update(Request $request, Payment $paymentHistory)
    {
        // Validate the request data
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        //check request
        if (!$request->hasFile('proof_of_payment')) {
            return redirect()->back()->with('error', 'No file uploaded');
        }

        //store file to storage
        $proof = $request->file('proof_of_payment')->store('proofs');

        //update payment history
        $paymentHistory->status = 'paid';
        $paymentHistory->validation = 'validated';
        $paymentHistory->proof = $proof;
        $paymentHistory->save();


        return redirect()->route('payment-histories.index')->with('success', 'Payment proof uploaded successfully');
    }
}

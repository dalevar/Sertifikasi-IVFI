<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('user')->where('status', 'success')->latest()->paginate(10);
        return view('admin.registrations.index', [
            'title' => 'Daftar Pendaftaran Sertifikasi',
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
    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        $registrations = Registration::with(['member.user', 'certification'])
            ->whereHas('member.user', function ($query) use ($user_id) {
                $query->where('id', $user_id);
            })->get();
        
        $countPending = 0;
        foreach($registrations as $register) {
            if ($register->status === "pending") {
                $countPending++;
            }
        }
        return view('admin.registrations.show', [
            'title' => 'Detail Pendaftaran ' . strtoupper($user->fullname),
            'registrations' => $registrations,
            'countPending' => $countPending
        ]);
    }

    public function approvedCertification(Request $request)
    {
        $request->validate([
            'registers' => 'required|array',
            'registers.*.id' => 'exists:registrations,id',
            'registers.*.status' => 'required'
        ]);

        foreach ($request->registers as $register) {
            Registration::where('id', $register['id'])->update([
                'status' => $register['status']
            ]);
        }

        return redirect()->back();
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
}

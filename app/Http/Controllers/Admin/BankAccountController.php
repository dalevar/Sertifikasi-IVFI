<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BankAccountRequest;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banks = BankAccount::latest()->paginate(5);
        return view('admin.bank-accounts.index', [
            'title' => 'Daftar Akun Bank',
            'banks' => $banks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bank-accounts.create', [
            'title' => 'Tambah Akun Bank'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BankAccountRequest $request)
    {
        $validate = $request->validated();

        BankAccount::create($validate);
        return to_route('admin.bank-accounts.index')->with('success', 'Data Berhasil Ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BankAccount $bankAccount)
    {
        return view('admin.bank-accounts.edit', [
            'title' => 'Ubah Data Akun Bank',
            'bank' => $bankAccount
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BankAccountRequest $request, BankAccount $bankAccount)
    {
        $validate = $request->validated();

        $bankAccount->update($validate);
        return to_route('admin.bank-accounts.index')->with('success', 'Data Berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->delete();
        return to_route('admin.bank-accounts.index')->with('success', 'Data Berhasil Dihapus.');
    }
}

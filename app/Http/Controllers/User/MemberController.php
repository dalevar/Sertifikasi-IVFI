<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();
        return view('user.member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:members,email',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        Member::create($request->all());
        return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = Member::findOrFail($id); // Find member by ID
        return view('user.member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id); // Find member by ID

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:members,email,' . $member->id,
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        $member->update($request->all());
        return redirect()->route('member.index')->with('success', 'Member berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::findOrFail($id); // Find member by ID
        $member->delete();

        return redirect()->route('member.index')->with('success', 'Member berhasil dihapus.');
    }
}

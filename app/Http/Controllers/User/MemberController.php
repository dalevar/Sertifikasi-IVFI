<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::with('user')->get();
        $user = Auth::user();
        return view('user.pages.profile.index', compact('members', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('user.pages.member.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'fullname' => 'required|string|max:255',
            'number_identity' => 'required|string|unique:members,number_identity',
            'birthplace' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
        ]);

        $member = Member::create($request->all());

        return redirect()->route('profile.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $users = User::all();
        return view('user.pages.member.edit', compact('member', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'fullname' => 'required|string|max:255',
            'number_identity' => 'required|string|unique:members,number_identity,' . $member->id,
            'birthplace' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
        ]);

        $member->update($request->all());

        return redirect()->route('members.index');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index');
    }
}

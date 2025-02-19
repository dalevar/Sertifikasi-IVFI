<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Member;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         *  $user = Auth::user(); returns the authenticated user.
         *  The compact() function creates an array from variables and their values.
         */

        $user = Auth::user();
        // Get all members where the user_id is equal to the authenticated user's id
        $members = Member::where('user_id', $user->id)->get();

        return view('user.pages.profile.index', compact('user', 'members'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(User $user)
    {
        return view('user.pages.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        // Validate the request data
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
        ]);

        // Update data user
        $user->update([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'photo' => $request->file('photo') ? $request->file('photo')->store('images/user', 'public') : $user->photo,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}

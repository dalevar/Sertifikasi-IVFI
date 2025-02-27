<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Member;
use App\Models\UserDetail;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\Certification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     */
    public function index()
    {
        $user = Auth::user()->load('details'); // Ambil data user + user_details
        $title = 'Profil Instansi';

        return view('user.pages.profile.index', compact('user', 'title'));
    }

    /**
     * Menampilkan halaman edit profil.
     */
    public function pengaturan()
    {
        $user = Auth::user()->load('details'); // Ambil data user + user_details
        $title = 'Pengaturan Profil';
        return view('user.pages.profile.pengaturan', compact('user', 'title'));
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'fullname' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        $changes = false;

        // Cek perubahan fullname
        if ($request->fullname !== $user->fullname) {
            $user->update(['fullname' => $request->fullname]);
            $changes = true;
        }

        // Cek perubahan address dan phone
        if ($request->address !== $user->details->address || $request->phone !== $user->details->phone) {
            $user->details->update([
                'address' => $request->address,
                'phone' => $request->phone,
            ]);
            $changes = true;
        }

        // Cek perubahan foto profil
        if ($request->hasFile('photo')) {
            if ($user->details->photo) {
                Storage::disk('public')->delete($user->details->photo);
            }
            $photoPath = $request->file('photo')->store('images/user', 'public');
            $user->details->update(['photo' => $photoPath]);
            $changes = true;
        }

        if (!$changes) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada perubahan pada profil!',
                'type' => 'warning'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui!',
        ]);
    }

    public function updateAkun(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $logout = false;
        $changes = false;

        if ($request->email !== $user->email) {
            $user->update(['email' => $request->email]);
            $logout = true;
            $changes = true;
        }

        if ($request->password) {
            $user->update(['password' => bcrypt($request->password)]);
            $logout = true;
            $changes = true;
        }

        if (!$changes) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada perubahan pada akun!',
                'type' => 'warning'
            ]);
        }

        if ($logout) {
            Auth::logout();
            return response()->json([
                'success' => true,
                'message' => 'Akun diperbarui! Silakan login kembali.',
                'logout' => true
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Akun berhasil diperbarui!',
            'logout' => false
        ]);
    }
}

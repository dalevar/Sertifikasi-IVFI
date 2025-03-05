<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\registration;
use App\Models\Certification;
use App\Models\Member;

class DownloadCertificateController extends Controller
{
    public function index()
    {
        $title = 'Download Certificate';
        $user = Auth::user();

        // Data member yang terhubung dengan user yang login
        $members = Member::where('user_id', $user->id)->get();

        // Mengambil data registerasi yang terhubung dengan member dan mengambil status 'approved'
        $registered = $members->map(function ($member) {
            return $member->registrations->where('status', 'approved');
        })->flatten();

        // Mengambil data sertifikat yang terhubung dengan registerasi
        $certificates = $registered->map(function ($registration) {
            return $registration->certification;
        })->unique();

        // Hitung jumlah anggota yang memiliki sertifikat
        $countMembersWithCertificates = $certificates->count();

        return view('user.pages.download.index', compact('user', 'registered', 'certificates', 'title', 'countMembersWithCertificates'));
    }


    public function show($id)
    {
        $title = 'Download Certificate';
        $user = Auth::user();

        // Mengambil data sertifikasi berdasarkan ID
        $certification = Certification::findOrFail($id);

        // Mengambil data member yang terdaftar pada sertifikasi ini dan milik user yang sedang login
        $members = $certification->registrations()
            ->whereHas('member', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with('member')
            ->get()
            ->pluck('member')
            ->unique();

        // Mengambil data registrasi yang memiliki status 'approved' dan milik user yang sedang login
        $registered = $certification->registrations()
            ->where('status', 'approved')
            ->whereHas('member', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        return view('user.pages.download.show', compact('user', 'certification', 'members', 'registered', 'title'));
    }
}

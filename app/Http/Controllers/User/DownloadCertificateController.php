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
        $user = Auth::user();

        // Data member yang terhubung dengan user yang login
        $members = Member::where('user_id', $user->id)->get();

        // Mengambil data registerasi yang terhubung dengan member dan mengambil status 'registered'
        $registered = $members->map(function ($member) {
            return $member->registrations->where('status', 'approved');
        })->flatten();

        // Mengambil data sertifikat yang terhubung dengan registerasi
        $certificates = $registered->map(function ($registration) {
            return $registration->certification;
        })->unique();

        return view('user.pages.download.index', compact('user', 'registered', 'certificates'));
    }

    public function show($id)
    {
        $user = Auth::user();

        // Mengambil data member berdasarkan id sertifikasi
        $certification = Certification::findOrFail($id);
        $members = $certification->registrations->map(function ($registration) {
            return $registration->member;
        });

        // Mengambil data registerasi yang terhubung dengan member dan mengambil status 'registered'
        $registered = $members->map(function ($member) {
            return $member->registrations->where('status', 'approved');
        })->flatten();

        return view('user.pages.download.show', compact('user', 'certification', 'members', 'registered'));
    }
}

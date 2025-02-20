<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Certification;


class PDFController extends Controller
{
    public function downloadPDF($id)
    {
        $user = Auth::user();

        // Mengambil data member berdasarkan id sertifikasi
        $certification = Certification::findOrFail($id);
        $members = $certification->registrations->map(function ($registration) {
            return $registration->member;
        });

        // Mengambil data registerasi yang terhubung dengan member dan mengambil status 'registered'
        $registered = $members->map(function ($member) {
            return $member->registrations->where('status', 'registered');
        })->flatten();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Certification;
use Dompdf\Dompdf;
use PDF;


class PDFController extends Controller
{
    public function download($memberId)
    {
        $user = Auth::user();

        // Mengambil data member berdasarkan id sertifikasi
        $certification = Certification::findOrFail($memberId);
        $members = $certification->registrations->map(function ($registration) {
            return $registration->member;
        });

        // Mengambil data registerasi yang terhubung dengan member dan mengambil status 'registered'
        $registered = $members->map(function ($member) {
            return $member->registrations->where('status', 'registered');
        })->flatten();

        $data = [
            'user' => $user,
            'certification' => $certification,
            'members' => $members,
            'registered' => $registered
        ];

        $pdf = PDF::loadView('pdf', $data);
        return $pdf->download('certificate.pdf');
    }
}

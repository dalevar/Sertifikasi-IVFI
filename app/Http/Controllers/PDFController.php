<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Registration;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function download($registrationId, $certificationId)
    {
        $user = Auth::user();

        // Validasi bahwa pengguna memiliki akses ke data ini
        $data = Registration::where('id', $registrationId)
            ->whereHas('certification', function ($query) use ($certificationId) {
                $query->where('id', $certificationId);
            })
            ->with(['member', 'certification'])
            ->firstOrFail();

        // Pastikan bahwa pengguna yang mengakses adalah pemilik data atau memiliki hak akses
        if ($data->member->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $filename = "{$data->member->fullname} - {$data->certification->title}.pdf";
        $title = "{$data->member->fullname} - {$data->certification->title}";
        $pdf = Pdf::loadView('pdf', ['data' => $data, 'title' => $title]);

        return $pdf->stream($filename);
    }
}

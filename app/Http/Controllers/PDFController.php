<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Registration;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function download($id)
    {
        $user = Auth::user()->load('details');
        $headmaster = $user->details->headmaster;

        $data = Registration::where('id', $id)->with(['member', 'certification'])->firstOrFail();
        $filename = "{$data->member->fullname} - {$data->certification->title}.pdf";
        $title = "{$data->member->fullname} - {$data->certification->title}";
        $pdf = Pdf::loadView('pdf', ['data' => $data, 'title' => $title, 'user' => $user, 'headmaster' => $headmaster]);
        return $pdf->stream($filename);
    }
}

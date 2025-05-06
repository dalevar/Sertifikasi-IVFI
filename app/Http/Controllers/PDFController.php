<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Registration;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function download($id)
    {
        $user = Auth::user()->load('details');
        $headmaster = $user->details->headmaster;

        $json = Storage::get("provinces.json");
        $provinces = json_decode($json, true);
        
        foreach ($provinces as $data) {
            if ($user->details->province == $data['id']) {
                $province = $data['name'];
            }
        }

        $data = Registration::where('id', $id)->with(['member', 'certification.competencyUnits'])->firstOrFail();

        $logo = $user->details->photo;

        $filename = "{$data->member->fullname} - {$data->certification->title}.pdf";
        $title = "{$data->member->fullname} - {$data->certification->title}";

        $pdf = Pdf::loadView('pdf', [
            'data' => $data, 
            'title' => $title, 
            'user' => $user, 
            'headmaster' => $headmaster, 
            'province' => $province,
            'logo' => $logo]);
        return $pdf->stream($filename);
    }
}

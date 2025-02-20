<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
    public function downloadPDF()
    {
        $user = Auth::user();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Check Roles
        if (auth()->user()->hasRole('admin')) {
            return view('home');
        }

        abort(403, 'Unauthorized');
        // return view('admin.dashboard');
        // return view('home');
    }
}

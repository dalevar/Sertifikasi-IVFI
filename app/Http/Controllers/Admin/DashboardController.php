<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->count();
        $members = Member::count();
        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'users' => $users,
            'members' => $members
        ]);
    }
}

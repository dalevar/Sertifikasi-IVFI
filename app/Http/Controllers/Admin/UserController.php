<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->withCount(['members'])->paginate(10);
        return view('admin.users.index', [
            'title' => 'Pengguna Terdaftar',
            'users' => $users
        ]);
    }

    public function show(string $id)
    {
        $user = User::with('details')->where('id', $id)->first();
        $members = Member::where('user_id', $id)->paginate(10);
        return view('admin.users.members', [
            'title' => 'Detail dan Daftar Anggota',
            'user' => $user,
            'members' => $members
        ]);
    }
}

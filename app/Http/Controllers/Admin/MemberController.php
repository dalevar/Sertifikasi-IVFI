<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function show($id) 
    {
        $member = Member::findOrFail($id);
        
        return view('admin.users.member-detail', [
            'title' => 'Detail Anggota',
            'member' => $member
        ]);
    }
}

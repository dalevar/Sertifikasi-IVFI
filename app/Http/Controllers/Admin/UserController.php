<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user')->withCount('members');

        if ($request->has('search') && $request->search !== '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('fullname', 'like', '%' . $searchTerm . '%')
                ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.users.index', [
            'title' => 'Pengguna Terdaftar',
            'users' => $users
        ]);
    }

    public function show(string $id)
    {
        $user = User::with('details')->where('id', $id)->first();
         $json = Storage::get("provinces.json");
        $provinces = json_decode($json, true);
        
        if ($user->details->province == NULL) {
            $province = "";
        } else {
            foreach ($provinces as $data) {
                if ($user->details->province == $data['id']) {
                    $province = $data['name'];
                }
            }
        }
        $members = Member::where('user_id', $id)->paginate(10);
        return view('admin.users.members', [
            'title' => 'Detail dan Daftar Anggota',
            'user' => $user,
            'members' => $members,
            'province' => $province
        ]);
    }

    public function resetPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make('12345678');
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Password berhasil direset ke 12345678.');
    }
}

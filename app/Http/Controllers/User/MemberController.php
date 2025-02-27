<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Registration;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $title = 'Members';
        // Mengambil data member yang terhubung dengan user yang sedang login
        $members = Member::where('user_id', $user->id)->get();

        // Menghitung Total data member yang terhubung dengan user yang sedang login
        $total_members = Member::where('user_id', $user->id)->count();

        return view('user.pages.member.index', compact('members', 'user', 'title', 'total_members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        $title = 'Add Member';
        return view('user.pages.member.create', compact('user', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\App\Http\Requests\User\MemberRequest $request)
    {
        $user = Auth::user();
        $validate = $request->validated();
        $validate['user_id'] = $user->id;

        try {
            $member = Member::create($validate);
            return response()->json([
                'success' => true,
                'message' => 'Anggota berhasil ditambahkan!',
                'member' => $member
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menambahkan anggota.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();

        $title = 'Member Details';
        $member = Member::find($id);

        $members_certificated = Registration::whereIn('member_id', $member)
            ->where('status', 'approved')
            ->get();

        return view('user.pages.member.show', compact('member', 'title', 'user', 'members_certificated'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $user = Auth::user();
        $title = 'Edit Member';
        return view('user.pages.member.edit', compact('member', 'user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate(
            [
                'fullname' => 'required|string|max:255',
                'number_identity' => 'required|string|unique:members,number_identity,' . $member->id,
                'birthplace' => 'required|string|max:255',
                'birthday' => 'required|date',
            ],
            [
                'fullname.required' => 'Nama lengkap wajib diisi.',
                'fullname.string' => 'Nama lengkap harus berupa teks.',

                'number_identity.required' => 'Nomor identitas wajib diisi.',
                'number_identity.string' => 'Nomor identitas harus berupa teks.',
                'number_identity.unique' => 'Nomor identitas sudah digunakan.',

                'birthplace.required' => 'Tempat lahir wajib diisi.',
                'birthplace.string' => 'Tempat lahir harus berupa teks.',

                'birthday.required' => 'Tanggal lahir wajib diisi.',
                'birthday.date' => 'Tanggal lahir harus berupa tanggal.',
            ]
        );

        try {
            $member =  $member->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Anggota berhasil diperbarui!',
                'member' => $member
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui anggota.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $member = Member::find($id);

        if (!$member) {
            return response()->json(['error' => 'Anggota tidak ditemukan!'], 404);
        }

        $member->delete();

        return response()->json(['message' => 'Anggota berhasil dihapus!']);
    }
}

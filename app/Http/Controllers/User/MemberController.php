<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Member;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\MemberRequest;
use App\Http\Requests\User\UpdateMemberRequest;

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

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // Simpan file ke storage/app/excel/
        $nama_file = $file->hashName();
        $path = $file->storeAs('excel', $nama_file);

        // Ambil path yang benar
        $filePath = Storage::path($path);

        // Pastikan file benar-benar ada sebelum diimport
        if (!Storage::exists($path)) {
            return response()->json([
                'success' => false,
                'message' => 'File tidak ditemukan setelah diunggah!',
            ], 500);
        }

        try {
            Excel::import(new \App\Imports\MembersImport(), $filePath);
            // Hapus file setelah sukses import
            Storage::delete($path);
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Diimport!'
            ], 200);
        } catch (\Exception $e) {
            // Hapus file jika terjadi error
            Storage::delete($path);

            return response()->json([
                'success' => false,
                'message' => 'Data Gagal Diimport!',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request)
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
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $validate = $request->validated();

        try {
            $member =  $member->update($validate);
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

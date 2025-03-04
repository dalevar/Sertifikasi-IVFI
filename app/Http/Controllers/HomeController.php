<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Member;
use App\Models\Registration;
use App\Models\Certification;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $title = 'Dashboard';
        // Ambil semua member berdasarkan user yang login
        $members = Member::where('user_id', $user->id)->get();

        // Hitung total member
        $total_members = $members->count();

        // Ambil semua registrasi yang berstatus 'approved' berdasarkan member yang dimiliki user
        $approved_registrations = Registration::whereIn('member_id', $members->pluck('id'))
            ->where('status', 'approved')
            ->count();

        $member_certificated = Registration::whereIn('member_id', $members->pluck('id'))
            ->where('status', 'approved')
            ->get();

        // Ambil aktivitas terbaru berdasarkan member yang dimiliki user
        $recent_activities = collect();
        if ($members->isNotEmpty()) {
            $recent_activities = Registration::whereIn('member_id', $members->pluck('id'))
                ->orderBy('updated_at', 'desc')
                ->take(5)
                ->get();
        }

        $certificate = Certification::all()->count();
        return view('user.dashboard', compact('user', 'title', 'members', 'total_members', 'approved_registrations', 'certificate', 'member_certificated', 'recent_activities'));
    }

    public function getMemberDetails($id)
    {
        // $certificated = Registration::where('id', $id)->with('member')->first();

        $user = Auth::user();

        $members = Member::where('user_id', $user->id)->get();
        $member_certificated = Registration::whereIn('member_id', $members->pluck('id'))
            ->where('status', 'approved')
            ->first();

        if (!$member_certificated) {
            return response()->json(['error' => 'Anggota tidak ditemukan!'], 404);
        }

        return response()->json([
            'fullname' => $member_certificated->member->fullname,
            'identity_number' => $member_certificated->member->number_identity,
            'title' => $member_certificated->certification->title,
            'status' => $member_certificated->status,
            'registration_date' => $member_certificated->registration_date->format('d/m/Y')
        ]);
    }
}

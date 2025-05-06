<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RomanHelper;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Registration;
use App\Models\User;
use App\Models\UserDetail;
use App\Services\CertificationNumberService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $payments = Payment::with('user')->where('status', 'success')->latest()->paginate(10);
        return view('admin.registrations.index', [
            'title' => 'Daftar Pendaftaran Sertifikasi',
            'payments' => $payments
        ]);
    }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        $registrations = Registration::with(['member.user', 'certification'])
            ->whereHas('member.user', function ($query) use ($user_id) {
                $query->where('id', $user_id);
            })->get();
        
        $countPending = 0;
        foreach($registrations as $register) {
            if ($register->status === "pending") {
                $countPending++;
            }
        }
        return view('admin.registrations.show', [
            'title' => 'Detail Pendaftaran ' . strtoupper($user->fullname),
            'registrations' => $registrations,
            'countPending' => $countPending,
            'user_id' => $user->id
        ]);
    }

    public function approved($user_id, $id)
    {
        $registration = Registration::findOrFail($id);
        $user = User::findOrFail($user_id);
        return view('admin.registrations.approved', [
            'title' => 'Terbitkan Sertifikat',
            'registration' => $registration,
            'user' => $user
        ]);
    }

 
    public function approvedCertification(Request $request)
    {
        $user = UserDetail::where('user_id', $request->user_id)->first();
        $validate = $request->validate([
            'status' => 'required'
        ]);

        $certification_number = $this->generateCertificationNumber($user->province);
        if ($validate['status'] === 'approved') {
        } else {
            $certification_number = null;
        }
        Registration::where('id', $request->registration_id)->update([
            'status' => $validate['status'],
            'certification_number' => $certification_number,
            'publication' => Carbon::now()
        ]);

        return redirect()->back();
    }

    private function generateCertificationNumber($province_id)
    {
        $provinceId = str_pad($province_id, 3, '0', STR_PAD_LEFT);

        $last = Registration::whereNotNull('certification_number')
                ->orderByRaw("CAST(SUBSTRING_INDEX(certification_number, '-', 1) AS UNSIGNED) DESC")
                ->first();

        if ($last && preg_match('/^(\d{3})-/', $last->certification_number, $matches)) {
            $lastNumber = (int)$matches[1];
        } else {
            $lastNumber = 0;
        }

        $nomorUrut = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        $romawi = RomanHelper::toRoman(Carbon::now()->month);
        $tahun = Carbon::now()->year;

        return "{$nomorUrut}-{$provinceId}/PP.IVFI-SERKOM/{$romawi}/{$tahun}";
    }
}

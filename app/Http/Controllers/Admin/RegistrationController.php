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
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\Renderers\PngRenderer;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        foreach ($registrations as $register) {
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
        $member = Registration::with('member')->where('id', $request->registration_id)->first();

        //Initialize QrCode
        $qrCodePath = null;
        $barcodePath = null;

        if ($validate['status'] === 'approved') {
            // Get the registration data
            $schoolName = $user->fullname;
            $headMaster = $user->headmaster;

            // Content for QR Code
            $qrCodeContent = "Sekolah: $schoolName\nKepala Sekolah: $headMaster";
            $barcodeContent = "$certification_number";

            // Generate QR Code
            $qrFileName = 'qrcodes/' . uniqid('qr_') . '.svg';
            $qrFullPath = storage_path('app/public/' . $qrFileName);
            QrCode::format('svg')->size(300)->generate($qrCodeContent, $qrFullPath);

            // Generate Barcode
            $barcodeFilename = 'barcodes/' . uniqid('bar_') . '.png';
            $geneatorBarcode = new BarcodeGeneratorPNG();
            $barcode = $geneatorBarcode->getBarcode($barcodeContent, $geneatorBarcode::TYPE_CODE_128);
            Storage::put($barcodeFilename, $barcode);
            
            // Store the QR Code path in the database
            $qrCodePath = 'storage/' . $qrFileName;
            $barcodePath = 'storage/' . $barcodeFilename;
        } else {
            $certification_number = null;
        }
        Registration::where('id', $request->registration_id)->update([
            'status' => $validate['status'],
            'certification_number' => $certification_number,
            'publication' => Carbon::now(),
            'qrcode_path' => $qrCodePath,
            'barcode_path' => $barcodePath
        ]);

        return redirect()->back();
    }

    public function resetCertification(Request $request)
    {
        $user = UserDetail::where('user_id', $request->user_id)->first();
        $member = Registration::with('member')->where('id', $request->registration_id)->first();
        
        if ($member->qrcode_path && Storage::disk('public')->exists(str_replace('storage/', '', $member->qrcode_path))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $member->qrcode_path));
        }

        if ($member->barcode_path && Storage::disk('public')->exists(str_replace('storage/', '', $member->barcode_path))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $member->barcode_path));
        }

        Registration::where('id', $request->registration_id)->update([
            'status' => 'pending',
            'certification_number' => null,
            'publication' => null,
            'qrcode_path' => null,
            'barcode_path' => null
        ]);

        return redirect()->back();
    }

    private function generateCertificationNumber($province_id)
    {
        $provinceId = str_pad($province_id, 3, '0', STR_PAD_LEFT);
        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;

        $last = Registration::whereNotNull('certification_number')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->orderByRaw("CAST(SUBSTRING_INDEX(certification_number, '-', 1) AS UNSIGNED) DESC")
            ->first();

        // $last = Registration::whereNotNull('certification_number')
        //     ->orderByRaw("CAST(SUBSTRING_INDEX(certification_number, '-', 1) AS UNSIGNED) DESC")
        //     ->first();

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

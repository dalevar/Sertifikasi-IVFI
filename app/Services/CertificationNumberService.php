<?php

namespace App\Services;

use App\Helpers\RomanHelper;
use App\Models\Registration;
use Carbon\Carbon;

class CertificationNumberService
{
  public function generate($province_id)
  {
    $provinceId = str_pad($province_id, 2, '0', STR_PAD_LEFT);

    $last = Registration::orderByDesc('created_at')->first();

    if ($last && preg_match('/^(\d{3})-/', $last->certification_number, $matches)) {
      $lastNumber = $matches[1];
    } else {
      $lastNumber = 0;
    }

    $nomorUrut = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    $romawi = RomanHelper::toRoman(Carbon::now()->month);
    $tahun = Carbon::now()->year;

    return "{$nomorUrut}-{$provinceId}/PP.IVFI-SERKOM/{$romawi}/{$tahun}";
  }
}
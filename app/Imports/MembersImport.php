<?php

namespace App\Imports;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MembersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $user = Auth::user();

        return new Member([
            'user_id'         => $user->id,
            'fullname'        => $row['nama_lengkap'], // Sesuai dengan header Excel
            'number_identity' => $row['nomor_identitas'],
            'birthplace'      => $row['tempat_lahir'],
            'birthday' => Carbon::parse($row['tanggal_lahir'])->format('Y-m-d'), // Format ke Y-m-d
            'gender'          => $row['jenis_kelamin'],
            'address'         => $row['alamat'],
            'phone'           => $row['telepon'],
            'email'           => $row['email']
        ]);
    }
}

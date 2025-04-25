<?php

namespace App\Imports;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;

class MembersImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    // public function model(array $row)
    // {
    //     $user = Auth::user();

    //     return new Member([
    //         'user_id'         => $user->id,
    //         'fullname'        => $row['nama_lengkap'], // Sesuai dengan header Excel
    //         'number_identity' => $row['nomor_identitas'],
    //         'birthplace'      => $row['tempat_lahir'],
    //         'birthday' => Carbon::parse($row['tanggal_lahir'])->format('Y-m-d'), // Format ke Y-m-d
    //         'gender'          => $row['jenis_kelamin'],
    //         'address'         => $row['alamat'],
    //         'phone'           => $row['telepon'],
    //         'email'           => $row['email']
    //     ]);
    // }

    public function collection(Collection $collection)
    {
        foreach ($collection as $index => $row) {
            if ($index === 0) continue;

            Member::create([
                'user_id'         => Auth::user()->id,
                'fullname'        => $row[0], // Sesuai dengan header Excel
                'number_identity' => $row[1],
                'birthplace'      => $row[2],
                'birthday'        => $row[3], // Format ke Y-m-d
                'gender'          => $row[4],
                'address'         => $row[5],
                'phone'           => $row[6],
                'email'           => $row[7]
            ]);
        }
    }
}

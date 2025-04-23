<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $fillable = [
        'member_id',
        'certification_id',
        'registration_date',
        'status',
        'serial_number',
        'certificate_number',
    ];


    protected $casts = [
        'registration_date' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function certification()
    {
        return $this->belongsTo(Certification::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($registration) {
            $last = Registration::orderBy('serial_number', 'desc')->first();
            $nextSerial = $last ? $last->serial_number + 1 : 1;

            $registration->serial_number = $nextSerial;
            $formattedSerial = str_pad($nextSerial, 3, '0', STR_PAD_LEFT);
            $year = Carbon::now()->format('Y');

            $registration->certificate_number = "{$formattedSerial}/SERKOM/{$year}";
        });
    }
}

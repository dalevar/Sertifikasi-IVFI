<?php

namespace App\Models;

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
}

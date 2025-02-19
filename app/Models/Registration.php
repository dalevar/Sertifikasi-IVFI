<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'member_id',
        'certification_id',
        'registration_date',
        'status'
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

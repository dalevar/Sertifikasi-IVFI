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


    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function certification()
    {
        return $this->belongsTo(Certification::class, 'certification_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'user_id',
        'total_members',
        'total_amount',
        'status',
        'date',
        'validation',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Members melalui User
    public function members()
    {
        return $this->hasMany(Member::class, 'user_id', 'user_id');
    }

    // Mengambil Sertifikasi dari Registrations melalui Members
    public function certifications()
    {
        return $this->hasManyThrough(
            Certification::class,
            Registration::class,
            'member_id',        // Foreign key di `registrations`
            'id',               // Foreign key di `certifications`
            'user_id',          // Foreign key di `members` untuk mencocokkan `payments`
            'certification_id'  // Foreign key di `registrations`
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certification extends Model
{
    use HasFactory;

    protected $table = 'certifications';

    protected $fillable = [
        'title',
        'description',
        'price',
        'valid_periode',
    ];

    protected $casts = [
        'valid_periode' => 'date',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'certification_id');
    }
}

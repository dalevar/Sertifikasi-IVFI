<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certification extends Model
{
    use HasFactory, SoftDeletes;

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

    public function competencyUnits()
    {
        return $this->hasMany(CompetencyUnit::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'certification_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetencyUnit extends Model
{
    use HasFactory;

    protected $table = 'competency_units';

    protected $fillable = [
        'unit_name',
        'unit_code',
        'certification_id'
    ];

    public function certification()
    {
        return $this->belongsTo(Certification::class);
    }
}

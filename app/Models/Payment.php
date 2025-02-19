<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'total_members',
        'total_amount',
        'status',
        'date',
        'validation',
        'proof'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

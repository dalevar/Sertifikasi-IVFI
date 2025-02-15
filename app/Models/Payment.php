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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

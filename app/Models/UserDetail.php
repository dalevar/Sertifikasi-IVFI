<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_details';

    protected $fillable = [
        'user_id',
        'photo',
        'address',
    'phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

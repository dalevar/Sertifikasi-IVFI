<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    public $table = 'user_details';

    protected $fillable = [
        'users_id',
        'photo',
        'address',
        'phone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}

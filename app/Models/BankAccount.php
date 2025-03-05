<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "bank_accounts";

    protected $fillable = [
        'bank_name',
        'account_number',
        'account_holder',
    ];

    public function payment()
    {
        $this->hasMany(Payment::class, 'bank_account_id');
    }
}

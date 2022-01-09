<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'name', 'gender', 'address', 'status', 'photo', 'nominal', 'incomes', 'received_at'
    ];

    public function getRouteKeyName()
    {
        return 'number';
    }

    public function merchant_income()
    {
        return $this->hasMany(Merchant::class);
    }
}

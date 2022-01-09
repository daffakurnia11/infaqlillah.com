<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant_income extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id', 'period', 'nominal', 'received_at'
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant_income::class);
    }
}

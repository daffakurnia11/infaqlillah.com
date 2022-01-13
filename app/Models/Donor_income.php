<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor_income extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'period',
        'nominal',
        'received_at'
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }
}

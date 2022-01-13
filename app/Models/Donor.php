<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'address',
        'donate'
    ];

    public function donor_income()
    {
        return $this->hasMany(Donor_income::class);
    }
}

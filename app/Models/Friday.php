<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friday extends Model
{
    use HasFactory;

    protected $fillable = [
        'category', 'in_charge', 'date_period', 'nominal', 'photo'
    ];
}

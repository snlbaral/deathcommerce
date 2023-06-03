<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountrySetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'stripe_currency',
        'store_currency',
        'system_language',
        'store_language',
    ];
}

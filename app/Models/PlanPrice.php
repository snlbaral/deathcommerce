<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id',
        'country',
        'currency',
        'monthly',
        'yearly',
    ];
}

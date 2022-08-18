<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'age_result',
        'status_result',
        'plafond_result',
        'business_age_result',
        'age_saw_result',
        'status_saw_result',
        'plafond_saw_result',
        'business_age_saw_result',
    ];
}

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
        'total_business_age_result',
    ];
}

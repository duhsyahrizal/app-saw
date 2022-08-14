<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'borrow_date',
        'is_approved'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}

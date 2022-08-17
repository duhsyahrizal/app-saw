<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'birth_date',
        'birth_location',
        'gender',
        'address_by_identity',
        'rw',
        'rt',
        'province',
        'district',
        'sub_district',
        'ward',
        'postal_code',
        'selfi_photo',
        'ktp_photo',
        'savings_photo',
        'face_with_ktp_photo',
        'status'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}

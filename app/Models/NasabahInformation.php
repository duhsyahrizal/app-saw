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
        'phone_number',
        'email',
        'nickname',
        'mother_name',
        'identity_photo',
        'parent_photo',
        'account_photo',
        'face_photo',
        'business_status',
        'status'
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}

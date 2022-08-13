<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nasabah;

class ApiController extends Controller
{
    public function datatableNasabah()
    {
        $nasabah    = Nasabah::get();

        foreach($nasabah as $item) {
            $data[] = [
                $item->name,
                $item->nik,
                $item->status,
                ''
            ];
        }

        return [
            'data'  => $data
        ];
    }
}

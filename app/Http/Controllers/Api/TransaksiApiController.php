<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransaksiResource;
use App\Models\Transaksi;

class TransaksiApiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::latest()->paginate(15);
        return TransaksiResource::collection($transaksis);
    }
}

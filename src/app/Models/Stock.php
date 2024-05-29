<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $filable = [
        'nama_produk',
        'kategori',
        'size',
        'jumlah_stock',
    ];

    public const kategori = [
        'kategori_1' => 'kemeja perempuan',
        'kategori_2' => 'kemeja laki-laki',

    ];
}
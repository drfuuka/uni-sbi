<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspeksi extends Model
{
    use HasFactory;

    protected $table = 'inspeksi';

    protected $fillable = [
        "kode_inspeksi",
        "inspektor_id",
        "nomor_id",
        "barang_id",
        "inspektor_sbi_area",
        "kepemilikan_alat",
        "periode_inspeksi",
        "nomor_register",
        "email_eht",
        "nama_perusahaan_kontraktor",
        "syarat_inspeksi",
        "kondisi",
        "status",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'inspektor_id', 'id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

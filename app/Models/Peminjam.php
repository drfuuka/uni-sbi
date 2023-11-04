<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjam extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'peminjam';

    protected $fillable = [
        'nama_peminjam',
        'jabatan',
        'department',
        'barang_id',
        'status'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

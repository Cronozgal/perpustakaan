<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'kode_buku',
        'judul_buku',
        'pengarang',
        'penerbit',
        'tahun',
        'stok',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

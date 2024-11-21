<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Menentukan tabel yang digunakan (opsional, jika tidak sesuai dengan penamaan default)
    protected $table = 'reports';

    // Daftar atribut yang bisa diisi secara massal
    protected $fillable = [
        'name',
        'date',
        'id_project',
        'product',
        'description',
    ];
}

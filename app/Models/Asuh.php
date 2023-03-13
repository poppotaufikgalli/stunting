<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asuh extends Model
{
    use HasFactory;

    protected $table = 'asuh';

    protected $fillable = [
        'nik',
        'orang_tua_asuh',
        'keterangan'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoUploadFile extends Model
{
    use HasFactory;

    protected $table = 'do_upload_file';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip',
        'nama_user',
        'nama_file',
        'nama_target_table',
        'jumlah_row',
    ];

}

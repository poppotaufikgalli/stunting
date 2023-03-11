<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akses extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'akses';

    public function groups()
    {
        return $this->belongsTo(Group::class, 'gid', 'id');
    }

    protected $fillable = [
        'nip',
        'nama',
        'no_hp',
        'gid',
        'crid',
        'upid'
    ];
}

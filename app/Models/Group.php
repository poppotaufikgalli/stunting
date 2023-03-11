<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'group';

    public function nakses()
    {
        return $this->hasMany(Akses::class, 'gid');
    }

    protected $fillable = [
        'nama',
        'lsakses',
        'crid',
        'upid',
    ];
}

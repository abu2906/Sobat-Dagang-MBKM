<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Disdag extends Authenticatable
{
    protected $table = 'disdag';
    protected $primaryKey = 'id_disdag';

    protected $fillable = [
        'nip',
        'nik',
        'nib',
        'email',
        'password',
        'telp',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = true;
}

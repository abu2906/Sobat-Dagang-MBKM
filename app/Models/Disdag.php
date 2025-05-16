<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * 
 *
 * @property int $id_disdag
 * @property string $password
 * @property string $nip
 * @property string $email
 * @property string|null $telp
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disdag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disdag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disdag query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disdag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disdag whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disdag whereIdDisdag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disdag whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disdag wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disdag whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disdag whereTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Disdag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Disdag extends Authenticatable
{
    protected $table = 'disdag';
    protected $primaryKey = 'id_disdag';

    protected $fillable = [
        'nip',
        'email',
        'password',
        'telp',
        'role'
    ];
    protected $guarded = []; // atau ['password', 'nip', dst...]

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $timestamps = true;
}

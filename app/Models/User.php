<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id_user
 * @property string $kecamatan
 * @property string $kelurahan
 * @property string $kabupaten
 * @property string $password
 * @property string $nik
 * @property string|null $nib
 * @property string $nama
 * @property string $alamat_lengkap
 * @property string $jenis_kelamin
 * @property string $telp
 * @property string $email
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAlamatLengkap($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereJenisKelamin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereKabupaten($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereKecamatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereKelurahan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNib($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNik($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel
    protected $table = 'user';

    // Primary key custom
    protected $primaryKey = 'id_user';

    // Autoincrement aktif
    public $incrementing = true;

    // Primary key bukan UUID (string), tapi integer
    protected $keyType = 'int';

    // Timestamps aktif
    public $timestamps = true;

    // Kolom yang bisa diisi mass-assignment
    protected $fillable = [
        'nama',
        'nik',
        'nib',
        'alamat_lengkap',
        'jenis_kelamin',
        'telp',
        'email',
        'telp',
        'password',
        'kabupaten',
        'kecamatan',
        'kelurahan',
<<<<<<< HEAD
        'kelurahan',
        'role'
=======
        'avatar'
>>>>>>> iniaaaini
    ];

    public function dataAlatUkurs()
    {
        return $this->hasMany(DataAlatUkur::class, 'id_user', 'id_user');
    }


    // Kolom yang harus disembunyikan saat serialisasi
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumDiskusi extends Model
{
    protected $table = 'forum_diskusi';
    protected $primaryKey = 'id_pengaduan'; // karena kamu pakai id_pengaduan sebagai primary key
    public $timestamps = false; // karena kamu pakai kolom waktu manual

    protected $fillable = [
        'id_user',
        'id_disdag',
        'chat',
        'waktu',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function disdag()
    {
        return $this->belongsTo(Disdag::class, 'id_disdag', 'id_disdag');
    }
}


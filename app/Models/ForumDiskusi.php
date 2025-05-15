<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumDiskusi extends Model
{
    protected $table = 'forum_diskusi';
    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'id_user',
        'id_disdag',
        'chat',
        'waktu',
    ];

    // Define the relationships with User model (assuming 'user' relation exists in ForumDiskusi)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

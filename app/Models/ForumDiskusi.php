<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ForumDiskusi extends Model
{
    use HasFactory;
    protected $table = 'forum_diskusi';
    protected $primaryKey = 'id_diskusi';
    public $timestamps = true;

    protected $fillable = ['id_user', 'guest_name', 'guest_email', 'chat'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

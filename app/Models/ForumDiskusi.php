<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForumDiskusi extends Model
{
    use HasFactory;

    protected $table = 'forum_diskusi';
    protected $primaryKey = 'id_diskusi';
    public $timestamps = false;

    protected $fillable = [
        'id_user', 'id_disdag', 'chat', 'waktu', 'status'
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

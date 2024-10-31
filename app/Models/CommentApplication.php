<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class CommentApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file',
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFileAttribute($file)
    {

        if ($file === null) {
            return null;
        } else {

            $extension = explode(".", $file);

            if (
                $extension[1] == 'mp4' ||
                $extension[1] == 'avi' ||
                $extension[1] == 'mov'
            ) {
                return asset('videos/' . $file);
            } else {
                return asset('images/' . $file);
            }
        }
    }
}

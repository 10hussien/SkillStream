<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalResource extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'resources_type',
        'resources_link'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

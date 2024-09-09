<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotulenTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'notulen_id',
        'task_topic',
        'task_pic',
        'guest_pic',  // Added guest_pic field
        'task_due_date',
        'status',
        'completion',  // Added completion field
        'description',
        'attachment',
    ];

    protected $casts = [
        'task_pic' => 'array',
        'guest_pic' => 'array',  // Cast guest_pic as an array
    ];

    public function notulen()
    {
        return $this->belongsTo(Notulen::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'task_pic');
    }

    public function logs()
    {
        return $this->hasMany(TaskLog::class, 'task_id');
    }
}

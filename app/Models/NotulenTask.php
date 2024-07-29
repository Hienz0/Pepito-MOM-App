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
        'task_due_date',
        'status',
        'description',
        'attachment',
    ];

    protected $casts = [
        'task_pic' => 'array',
    ];

    public function notulen()
    {
        return $this->belongsTo(Notulen::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'task_pic');
    }
}

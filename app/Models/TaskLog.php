<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_id',
        'update_description',
        'updated_by',
    ];

    /**
     * Get the task associated with the log.
     */
    public function task()
    {
        return $this->belongsTo(NotulenTask::class, 'task_id');
    }

    /**
     * Get the user who made the update.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

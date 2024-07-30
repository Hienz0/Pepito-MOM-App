<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_title',
        'department',
        'meeting_date',
        'meeting_time',
        'meeting_location',
        'agenda',
        'discussion',
        'decisions',
        'action_items',
        'scripter_id'
    ];

    public function participants()
    {
        return $this->belongsToMany(User::class, 'notulen_user');
    }

    public function tasks()
    {
        return $this->hasMany(NotulenTask::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function scripter()
    {
        return $this->belongsTo(User::class, 'scripter_id');
    }
}

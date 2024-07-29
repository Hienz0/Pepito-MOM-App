<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_title',
        'meeting_date',
        'meeting_time',
        'agenda',
        'discussion',
        'decisions',
        'action_items',
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
}

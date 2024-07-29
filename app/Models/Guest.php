<?php

// app/Models/Guest.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'notulen_id',
        'name',
        'email',
    ];

    public function notulen()
    {
        return $this->belongsTo(Notulen::class);
    }
}

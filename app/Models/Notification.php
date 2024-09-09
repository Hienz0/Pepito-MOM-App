<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'notifications';

    // Specify the fillable fields for mass assignment
    protected $fillable = [
        'user_id',
        'notulen_id',
        'notification_topic',
        'notification_message',
        'read_status',
        'read_time',  // Added read_time to fillable
    ];

    // Relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mark a notification as read and set the read time
    public function markAsRead()
    {
        $this->update([
            'read_status' => true,
            'read_time' => Carbon::now(),  // Set current timestamp when marking as read
        ]);
    }
}

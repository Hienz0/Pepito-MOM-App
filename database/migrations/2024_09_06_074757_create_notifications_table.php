<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method creates the 'notifications' table
     * with the following columns:
     * - id: Primary key
     * - user_id: Foreign key referencing the 'users' table
     * - notulen_id: Foreign key referencing the 'notulens' table
     * - notification_topic: A string for the notification title/topic
     * - notification_message: A text field for the notification message
     * - read_status: A boolean to track if the notification is read or not (default is false)
     * - read_time: Nullable timestamp indicating when the notification was read
     * - timestamps: Standard Laravel fields for created_at and updated_at
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Foreign key referencing users table
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Foreign key referencing notulens table
            $table->unsignedBigInteger('notulen_id')->nullable();
            $table->foreign('notulen_id')->references('id')->on('notulens')->onDelete('cascade');

            // Notification details
            $table->string('notification_topic');
            $table->text('notification_message');

            // Read status: false by default
            $table->boolean('read_status')->default(false);

            // Nullable read time to track when the notification was read
            $table->timestamp('read_time')->nullable();

            // Timestamps for record creation and updates
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method drops the 'notifications' table.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

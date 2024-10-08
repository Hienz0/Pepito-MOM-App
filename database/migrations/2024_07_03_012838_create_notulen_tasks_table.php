<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotulenTasksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notulen_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notulen_id')->constrained()->onDelete('cascade');
            $table->string('task_topic');
            $table->json('task_pic'); 
            $table->json('guest_pic')->nullable(); // New nullable guest_pic column
            $table->date('task_due_date');
            $table->string('status')->default('Pending');
            $table->string('completion')->default('0%'); // New column for task completion
            $table->text('description')->nullable();
            $table->string('attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('notulen_tasks');
    }
}

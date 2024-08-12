<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotulensTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notulens', function (Blueprint $table) {
            $table->id();
            $table->string('meeting_title');
            $table->string('department');
            $table->date('meeting_date');
            $table->time('meeting_time');
            $table->string('meeting_location');
            $table->text('agenda');
            $table->text('discussion');
            $table->text('decisions');
            $table->foreignId('scripter_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('Open');
            $table->timestamps();
        });

        Schema::create('notulen_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notulen_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('notulen_user');
        Schema::dropIfExists('notulens');
    }
}

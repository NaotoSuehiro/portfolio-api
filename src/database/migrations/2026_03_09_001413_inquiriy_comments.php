<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inquiry_comments', function (Blueprint $table) {
            $table->uuid('inquiry_comment_id')->primary();
            $table->uuid('inquiry_task_id');
            $table->foreign('inquiry_task_id')->references('inquiry_task_id')->on('inquiry_tasks');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('inquiry_comments');
       Schema::dropIfExists('inquiry_talks');
    }
};

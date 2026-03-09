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
        Schema::create('inquiry_tasks', function (Blueprint $table) {
            $table->uuid('inquiry_task_id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->string('title');
            $table->text('content');
            $table->enum('status', ['UNSUPPORTED','IN_PROGRESS','WAITING_REPLY','COMPLETED'])->default('UNSUPPORTED')->comment('UNSUPPORTED:未対応, IN_PROGRESS:対応中, WAITING_REPLY:返信待ち, COMPLETED:完了');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('inquiry_tasks');
    }
};

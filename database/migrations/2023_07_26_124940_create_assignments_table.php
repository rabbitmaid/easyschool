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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins', 'id')->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('classes', 'id')->cascadeOnDelete();
            $table->foreignId('course_id')->constrained('courses', 'id')->cascadeOnDelete();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->longText('file')->nullable();
            $table->foreignId('status_id')->constrained('statuses', 'id')->cascadeOnDelete();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};

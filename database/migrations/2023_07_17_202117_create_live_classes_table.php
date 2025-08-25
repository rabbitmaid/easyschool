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
        Schema::create('live_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('live_class_method_id')->constrained('live_class_methods', 'id')->cascadeOnDelete();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('link');
            $table->foreignId('status_id')->constrained('statuses', 'id')->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('classes', 'id')->cascadeOnDelete();
            $table->foreignId('admin_id')->constrained('admins', 'id')->cascadeOnDelete();
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
        Schema::dropIfExists('live_classes');
    }
};

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
        Schema::create('admin_class', function (Blueprint $table) {
            $table->foreignId('admin_id')->constrained('admins', 'id')->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('classes', 'id')->cascadeOnDelete();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_class');
    }
};

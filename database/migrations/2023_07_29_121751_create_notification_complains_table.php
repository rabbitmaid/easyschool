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
        Schema::create('notification_complains', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->foreignId('complain_id')->constrained('complains', 'id')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('admin_id')->constrained('admins', 'id')->cascadeOnDelete();
            $table->longText('description');
            $table->boolean('is_read');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_complains');
    }
};

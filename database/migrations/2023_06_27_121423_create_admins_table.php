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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('username');
            $table->foreignId('role_id')->constrained('roles', 'id')->cascadeOnDelete();
            $table->string('email')->unique();
            $table->foreignId('status_id')->constrained('statuses', 'id')->cascadeOnDelete();
            $table->foreignId('gender_id')->constrained('genders', 'id')->cascadeOnDelete();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->longText('profile_image')->nullable();
            $table->foreignId('course_id')->constrained('courses', 'id');
            $table->longText('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};

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
        Schema::create('complain_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complain_id')->constrained('complains', 'id')->cascadeOnDelete();
            $table->foreignId('admin_id')->constrained('admins', 'id')->cascadeOnDelete();
            $table->longText('reply');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complain_replies');
    }
};

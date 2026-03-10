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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('original_name')->nullable();
            $table->text('mime')->nullable();
            $table->text('extension');
            $table->text('size')->nullable();
            $table->text('path');
            $table->text('group');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('hash')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};

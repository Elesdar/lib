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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('type');
            $table->foreignId('books_list_id')->constrained('books_lists')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->integer('read_count');  // количество прочтений
            $table->integer('count_pages')->nullable();
            $table->integer('count_finished_pages')->nullable(); // прочитанные страницы
            $table->text('author')->nullable();
            $table->date('publishing_date')->nullable();
            $table->integer('rating')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

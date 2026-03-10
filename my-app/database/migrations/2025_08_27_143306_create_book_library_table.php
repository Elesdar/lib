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
        Schema::create('book_library', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->foreignId('library_id')->constrained('libraries')->onDelete('cascade');
            $table->integer('format');
            $table->tinyText('isbn')->nullable();
            $table->date('year')->nullable();
            $table->string('publisher')->nullable();
            $table->integer('cover_format')->nullable();
            $table->decimal('purchase_price', 150, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->text('purchase_place')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_libraries');
    }
};

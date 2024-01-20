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
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('comic_id')->constrained();
            $table->foreignId('serie_id')->constrained();
            $table->integer('volume')->nullable();
            $table->boolean('obtained')->nullable();
            $table->string('condition')->nullable();
            $table->text('notes')->nullable();
            $table->string('image')->nullable();
            $table->string('cover')->nullable();
            $table->string('color')->nullable();
            $table->string('print_year')->nullable();
            $table->string('purchase_place')->nullable();
            $table->decimal('purchase_price')->nullable();
            $table->date('purchase_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};

<?php

declare(strict_types=1);

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
        Schema::create('editions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('album_id')->constrained();
            $table->foreignId('serie_id')->constrained();
            $table->string('volume');
            $table->string('image')->nullable();
            $table->string('cover')->nullable();
            $table->string('color')->nullable();
            $table->date('release_date')->nullable();
            $table->timestamps();

            $table->unique(['album_id', 'serie_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editions');
    }
};

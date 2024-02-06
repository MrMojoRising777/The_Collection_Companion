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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');         // USER
            $table->foreignId('album_id')->constrained('albums');       // ALBUM
            $table->date('acquisition_date');                           // COLLECTION - ACQUIRE DATE
            $table->boolean('favorite')->nullable();                    // ALBUM - FAVORITE
            $table->boolean('first_print')->nullable();                 // ALBUM - FIRST PRINT OWNED
            $table->string('condition')->nullable();                    // ALBUM - CONDITION (dropdown menu)
            $table->text('damage')->nullable();                         // ALBUM - DAMAGES (if damaged)
            $table->text('notes')->nullable();                          // ALBUM - NOTES (could be combined with damages)
            $table->string('print_year')->nullable();                   // ALBUM - PRINT DATE OWNED
            // $table->string('purchase_place')->nullable();               // ARE THESE NECESSARY
            // $table->decimal('purchase_price')->nullable();              // ARE THESE NECESSARY
            // $table->date('purchase_date')->nullable();                  // ARE THESE NECESSARY
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};

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
        Schema::create('owned_copies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('edition_id')->constrained();

            $table->date('acquisition_date');
            $table->boolean('favorite')->default(false);
            $table->boolean('first_print')->default(false);
            $table->string('condition')->nullable();
            $table->text('notes')->nullable();
            $table->string('print_year')->nullable();
            // $table->string('purchase_place')->nullable();
            // $table->decimal('purchase_price')->nullable();
            // $table->date('purchase_date')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'edition_id']);
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

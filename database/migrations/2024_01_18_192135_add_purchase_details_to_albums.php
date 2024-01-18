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
        Schema::table('albums', function (Blueprint $table) {
            $table->string('purchase_place')->nullable()->after('condition');
            $table->decimal('purchase_price')->nullable()->after('purchase_place');
            $table->date('purchase_date')->nullable()->after('purchase_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('albums', function (Blueprint $table) {
            $table->dropColumn('purchase_place');
            $table->dropColumn('purchase_price');
            $table->dropColumn('purchase_date');
        });
    }
};

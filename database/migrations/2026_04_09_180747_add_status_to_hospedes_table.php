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
        Schema::table('hospedes', function (Blueprint $table) {
            $table->enum('status',['hospede','hospedado'])->default('hospede');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hospedes', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

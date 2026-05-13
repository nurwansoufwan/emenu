<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('laporans', function (Blueprint $table) {
        $table->id();
        $table->string('periode'); // Format: YYYY-MM
        $table->decimal('pendapatan', 15, 2);
        $table->integer('total_pesanan');
        $table->enum('status', ['naik', 'stabil', 'turun']);
        $table->text('catatan')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};

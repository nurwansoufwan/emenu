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
        Schema::table('food', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('id')->constrained('categories')->onDelete('set null');
            // Kita biarkan kolom 'category' lama dulu untuk sementara, atau hapus jika yakin
            // $table->dropColumn('category'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};

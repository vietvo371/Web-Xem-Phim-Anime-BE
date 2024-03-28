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
        Schema::create('tap_phims', function (Blueprint $table) {
            $table->id();
            $table->string('ten_tap_phim');
            $table->string('slug_tap_phim');
            $table->string('url');
            $table->integer('id_phim');
            $table->integer('tinh_trang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tap_phims');
    }
};

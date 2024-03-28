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
        Schema::create('admin_animes', function (Blueprint $table) {
            $table->id();
            $table->string('email')->uniqie();
            $table->string('ho_va_ten');
            $table->string('password');
            $table->longText('hinh_anh');
            $table->integer('id_chuc_vu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_animes');
    }
};

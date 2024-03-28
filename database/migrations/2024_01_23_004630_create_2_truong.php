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
        Schema::table('khach_hangs', function (Blueprint $table) {
            $table->string('hash_quen_mat_khau')->nullable();
            $table->string('hash_kich_hoat')->nullable();
            $table->integer('is_done');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('khach_hangs', function (Blueprint $table) {
            //
        });
    }
};

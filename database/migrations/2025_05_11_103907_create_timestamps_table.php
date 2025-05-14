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
        Schema::create('timestamps', function (Blueprint $table) {
            $table->id()->primary();
            $table->timestamp('check_in')->nullable(true);
            $table->timestamp('check_out')->nullable(true);
            $table->boolean('has_checked_in')->nullable(true);
            $table->boolean('has_checked_out')->nullable(true);
            $table->double('latitude_check_in')->nullable(true);
            $table->double('latitude_check_out')->nullable(true);
            $table->double('longitude_check_in')->nullable(true);
            $table->double('longitude_check_out')->nullable(true);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timestamps');
    }
};

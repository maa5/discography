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
        Schema::create('l_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 255)->unique();
            $table->unsignedBigInteger('artist_id');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('artist_id')->references('id')->on('artists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_p_s');
    }
};

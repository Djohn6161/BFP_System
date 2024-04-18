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
        Schema::create('afor_casualties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('afor_id')->constrained('afor')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('type', ['civillian','firefighters']);
            $table->integer('injured');
            $table->integer('death');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('afor_casualties');
    }
};
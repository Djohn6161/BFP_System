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
        Schema::create('investigation_casualties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investigations')->constrained('investigations')->onUpdate('cascade');
            $table->enum('type', ['civillian','firefighters']);
            $table->integer('fatality');
            $table->integer('injured');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investigation_casualties');
    }
};

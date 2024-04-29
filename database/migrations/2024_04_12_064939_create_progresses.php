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
        Schema::create('progresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spot_id')->constrained('spots')->onUpdate('cascade');
            $table->foreignId('investigation_id')->constrained('investigations')->onUpdate('cascade');
            $table->longText('authority');
            $table->longText('matters_investigated');
            $table->longText('facts_of_the_case');
            $table->string('disposition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};

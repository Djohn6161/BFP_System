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
        Schema::create('spots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('investigation_id')->constrained('investigations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignid('afor_id')->nullable()->constrained('afors')->onUpdate('cascade')->onDelete('set null');
            $table->date('date_occurence');
            $table->string('time_occurence');
            $table->string('barangay')->nullable();
            $table->string('street')->nullable();
            $table->string('landmark')->nullable();
            $table->string('address_occurence')->nullable();
            $table->string('involved');
            $table->string('name_of_establishment');
            $table->string('owner');
            $table->string('occupant');
            $table->integer('fatality')->default(0);
            $table->integer('injured')->default(0);
            $table->decimal('estimate_damage');
            $table->string('time_fire_start');
            $table->string('time_fire_out');
            $table->foreignId('alarm')->constrained('alarm_names')->onUpdate('cascade');;
            $table->longText('details');
            $table->longText('disposition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spots');
    }
};

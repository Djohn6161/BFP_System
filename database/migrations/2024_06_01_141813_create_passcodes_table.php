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
        Schema::create('passcodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("creators_id")->nullable()->constrained("users")->onUpdate("cascade")->onDelete("set null");
            $table->string("code");
            $table->boolean("status");
            $table->foreignId("users_id")->nullable()->constrained("users")->onUpdate("cascade")->onDelete("set null");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passcodes');
    }
};

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
        Schema::create('placard_records', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->foreignId('world_cup_year_id')->constrained('world_cup_years')->cascadeOnDelete();
            $table->unsignedInteger('download_count')->default(1);
            $table->string('ip_address');
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->unique(['ip_address', 'country_id', 'world_cup_year_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placard_records');
    }
};

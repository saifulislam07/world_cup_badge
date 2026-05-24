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
        Schema::create('world_cup_matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('match_number')->unique();
            $table->string('stage');
            $table->string('group', 8)->nullable();
            $table->string('home_team');
            $table->string('away_team');
            $table->dateTime('kickoff_at');
            $table->string('venue');
            $table->string('status')->default('scheduled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('world_cup_matches');
    }
};

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
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->nullable();
            $table->string('session_id', 120)->nullable();
            $table->string('method', 10);
            $table->string('path');
            $table->text('full_url');
            $table->string('route_name')->nullable();
            $table->text('referer')->nullable();
            $table->text('user_agent')->nullable();
            $table->dateTime('visited_at');

            $table->index('visited_at');
            $table->index('ip_address');
            $table->index('path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};

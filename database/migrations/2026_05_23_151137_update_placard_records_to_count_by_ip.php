<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('placard_records', function (Blueprint $table) {
            if ($this->indexExists('placard_records_phone_country_id_world_cup_year_id_unique')) {
                $table->dropUnique('placard_records_phone_country_id_world_cup_year_id_unique');
            }
            $table->string('phone')->nullable()->change();
            $table->string('ip_address')->nullable(false)->change();
            if (! $this->indexExists('placard_records_ip_country_year_unique')) {
                $table->unique(['ip_address', 'country_id', 'world_cup_year_id'], 'placard_records_ip_country_year_unique');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('placard_records', function (Blueprint $table) {
            if ($this->indexExists('placard_records_ip_country_year_unique')) {
                $table->dropUnique('placard_records_ip_country_year_unique');
            }
            $table->string('phone')->nullable(false)->change();
            $table->string('ip_address')->nullable()->change();
            if (! $this->indexExists('placard_records_phone_country_id_world_cup_year_id_unique')) {
                $table->unique(['phone', 'country_id', 'world_cup_year_id']);
            }
        });
    }

    private function indexExists(string $indexName): bool
    {
        return collect(DB::select('SHOW INDEX FROM placard_records'))
            ->contains(fn ($index) => $index->Key_name === $indexName);
    }
};

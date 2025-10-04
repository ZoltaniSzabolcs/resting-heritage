<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('cemeteries')) {
            Schema::create('cemeteries', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name');
                $table->string('city')->nullable();
                $table->string('description')->nullable();
                $table->magellanPolygon('boundary')->nullable();
                $table->magellanPoint('entrance', 4326)->nullable();
                $table->magellanPoint('center', 4326)->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cemeteries');
    }
};

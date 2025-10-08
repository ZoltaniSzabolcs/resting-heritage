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
        if (!Schema::hasTable('graves')) {
            Schema::create('graves', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name')->nullable();
                $table->magellanPolygon('boundary')->nullable();
                $table->magellanPoint('location', 4326)->nullable();
                $table->timestamps();
            });
        }

        Schema::table('graves', function (Blueprint $table) {
            $table->foreignUuid('cemetery_id')->references('id')->on('cemeteries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graves');
    }
};

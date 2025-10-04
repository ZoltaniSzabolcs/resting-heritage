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
        if (!Schema::hasTable('persons')) {
            Schema::create('persons', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('initials')->nullable();
                $table->date('birth_date')->nullable();
                $table->date('death_date')->nullable();
                $table->string('birth_place')->nullable();
                $table->string('death_place')->nullable();
                $table->text('biography')->nullable();
                $table->string('occupation')->nullable();
                $table->string('image_url')->nullable();
                $table->timestamps();
            });
        }

        Schema::table('persons', function (Blueprint $table) {
            $table->foreignUuid('grave_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeMediaModelIdToString extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('media') || ! Schema::hasColumn('media', 'model_id')) {
            return;
        }

        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");

        if ($driver === 'pgsql') {
            // Cast existing values to varchar to avoid type errors
            DB::statement("ALTER TABLE media ALTER COLUMN model_id TYPE varchar(36) USING model_id::varchar");
        } else {
            Schema::table('media', function (Blueprint $table) {
                $table->string('model_id', 36)->change();
            });
        }
    }

    public function down()
    {
        if (! Schema::hasTable('media') || ! Schema::hasColumn('media', 'model_id')) {
            return;
        }

        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");

        if ($driver === 'pgsql') {
            // Attempt to cast back to bigint (may fail if non-numeric values exist)
            DB::statement("ALTER TABLE media ALTER COLUMN model_id TYPE bigint USING model_id::bigint");
        } else {
            Schema::table('media', function (Blueprint $table) {
                $table->unsignedBigInteger('model_id')->change();
            });
        }
    }
}

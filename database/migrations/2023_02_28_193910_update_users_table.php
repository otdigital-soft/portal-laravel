<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');
            $table->string('username')->nullable()->change();
        });

        // Copy data from 'name' to 'first_name' and 'last_name'
        DB::table('users')->update([
            'first_name' => DB::raw('SUBSTRING_INDEX(name, " ", 1)'),
            'last_name' => DB::raw('SUBSTRING_INDEX(name, " ", -1)'),
        ]);

        // Remove the 'name' column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable();
        });

        // Combine 'first_name' and 'last_name' and copy to 'name'
        DB::table('users')->update([
            'name' => DB::raw('CONCAT(first_name, " ", last_name)'),
        ]);

        // Remove the 'first_name' and 'last_name' columns
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name']);
        });
    }
}

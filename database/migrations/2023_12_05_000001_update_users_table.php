<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            // Rename the 'name' column to 'fullname'
            $table->renameColumn('name', 'fullname');
            
            // Add a new 'username' column
            $table->string('username')->unique()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse the change: Remove the 'username' column
            $table->dropColumn('username');

            // Reverse the change: Rename the 'fullname' column back to 'name'
            $table->renameColumn('fullname', 'name');
        });
    }
}

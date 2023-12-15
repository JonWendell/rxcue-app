<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUserIdColumnFromBranches extends Migration
{
    public function up()
    {
        Schema::table('branches', function (Blueprint $table) {
            // Drop the user_id column
            $table->dropColumn('user_id');
        });
    }

    public function down()
    {
        // Implement the reverse operation if needed
    }
}

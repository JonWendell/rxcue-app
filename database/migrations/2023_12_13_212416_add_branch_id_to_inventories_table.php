<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchIdToInventoriesTable extends Migration
{
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            // Add the branch_id column
            $table->unsignedBigInteger('branch_id')->nullable();

            // Add a foreign key constraint if needed
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            // Remove the branch_id column
            $table->dropColumn('branch_id');
        });
    }
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveBranchIdFromSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    // Drop foreign key constraint
    Schema::table('sales', function (Blueprint $table) {
        $table->dropForeign(['branch_id']);
    });

    // Drop the column
    Schema::table('sales', function (Blueprint $table) {
        $table->dropColumn('branch_id');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_id')->nullable();
        });
    }
}

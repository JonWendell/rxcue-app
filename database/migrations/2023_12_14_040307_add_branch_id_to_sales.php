<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('sales', function (Blueprint $table) {
        $table->unsignedBigInteger('branch_id')->nullable()->after('user_id');
        $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('sales', function (Blueprint $table) {
        $table->dropForeign(['branch_id']);
        $table->dropColumn('branch_id');
    });
}
};

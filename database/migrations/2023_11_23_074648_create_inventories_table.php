<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToInventoriesTable extends Migration
{
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('image')->nullable();
            $table->enum('category', ['fluid', 'solid', 'other'])->nullable();
            $table->decimal('price', 8, 2)->default(0.00);
        });
    }

    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn(['description', 'quantity', 'image', 'category', 'price']);
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // In the migration file
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('previous_quantity')->default(0);
            $table->integer('quantity_change')->default(0);
            $table->integer('new_quantity')->default(0);
            $table->date('change_date');
            $table->timestamps();
        });
    }

};

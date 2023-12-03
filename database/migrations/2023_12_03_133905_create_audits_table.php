<?php

// database/migrations/{timestamp}_create_audits_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_id');
            $table->integer('current_quantity');
            $table->integer('quantity');
            $table->integer('new_stock');
            $table->string('type'); // You might want to use an enum for this
            $table->timestamps();

            // Define foreign key relationship
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('audits');
    }
}

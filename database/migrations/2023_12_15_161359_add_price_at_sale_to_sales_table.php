<?php

// database/migrations/xxxx_xx_xx_add_price_at_sale_to_sales_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceAtSaleToSalesTable extends Migration
{
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->decimal('price_at_sale', 10, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('price_at_sale');
        });
    }
}


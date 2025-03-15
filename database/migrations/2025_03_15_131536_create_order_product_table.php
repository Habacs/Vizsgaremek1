<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration{
    public function up(){
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreidnId('order_id')->constrained()->onDelete('cascade');
            $table->foreidnId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->timestamps();
    });
}

public function down(){
    Schema::dropIfExists('order_products');
}
}
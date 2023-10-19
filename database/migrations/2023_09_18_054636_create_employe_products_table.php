<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employe_products', function (Blueprint $table) {
            $table->id();
            $table->integer('employe_id');
            $table->integer('position_product_id');
            $table->integer('count');
            $table->bigInteger('nomenclature');
            $table->double('price', 15,2);
            $table->datetime('date_of_receipt')->nullable();
            $table->boolean('toggle_confirmation')->default(false);
            $table->datetime('date_write_off')->nullable();
            $table->boolean('toggle_write_off')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employe_products');
    }
};

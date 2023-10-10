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
        Schema::create('position_products', function (Blueprint $table) {
            $table->id();
            $table->integer('position_id');
            $table->integer('product_id');
            $table->integer('working_condition_id');
            $table->integer('count')->default(1);
            $table->string('expiration_date')->nullable();
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
        Schema::dropIfExists('position_products');
    }
};

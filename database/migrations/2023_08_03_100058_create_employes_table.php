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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('table_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('second_name');
            $table->integer('position_id');
            $table->datetime('hiring_date');
            $table->boolean('gender');
            $table->integer('organization_id');
            $table->integer('division_id')->nullable();
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
        Schema::dropIfExists('employes');
    }
};

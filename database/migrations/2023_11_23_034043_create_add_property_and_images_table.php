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
        Schema::create('add_property_and_images', function (Blueprint $table) {
            $table->id();
            $table->string (column: 'property_name');
            $table->string (column: 'property_address');
            $table->string (column: 'property_type');
            $table->string (column: 'bedrooms');
            $table->string (column: 'bathrooms');
            $table->string (column: 'price');
            $table->string (column: 'lot_area');
            $table->string (column: 'floor_area');
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
        Schema::dropIfExists('add_property_and_images');
    }
};

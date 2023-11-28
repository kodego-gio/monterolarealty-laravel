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
        Schema::create('user_registration', function (Blueprint $table) {
            $table->id();
            $table->string (column: 'firstname');
            $table->string (column: 'lastname');
            $table->integer (column: 'contact');
            $table->string (column: 'email')->unique();
            $table->string (column: 'password');
            $table->string (column: 'fb_link');
            $table->string (column: 'usertype');
             $table->rememberToken();
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
        Schema::dropIfExists('user_registration');
    }
};

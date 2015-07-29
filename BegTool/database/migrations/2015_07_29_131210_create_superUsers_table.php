<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('superUsers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password', 60);  
            $table->boolean('admin');  
            $table->boolean('preacher');
            $table->boolean('kigo');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('tbl_property'))
        {
            Schema::create('tbl_property', function (Blueprint $table) 
            {
                $table->increments('id');

                $table->string('name', 150)->nullable();
                $table->integer('price')->unsigned()->nullable();
                $table->integer('bedroom')->unsigned()->nullable();
                $table->integer('bathroom')->unsigned()->nullable();
                $table->integer('store')->unsigned()->nullable();
                $table->integer('garage')->unsigned()->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_property');
    }
}

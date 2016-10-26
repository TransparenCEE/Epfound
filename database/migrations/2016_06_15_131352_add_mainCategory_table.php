<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMainCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mainCategory', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('name');
            $table->integer('main',1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mainCategory', function (Blueprint $table) {
            //
        });
    }
}

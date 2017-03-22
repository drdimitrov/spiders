<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genera', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('paper_id')->unsigned();
            $table->integer('family_id')->unsigned();
            $table->timestamps();

            $table->foreign('paper_id')
              ->references('id')->on('papers');

            $table->foreign('family_id')
              ->references('id')->on('families');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genera');
    }
}

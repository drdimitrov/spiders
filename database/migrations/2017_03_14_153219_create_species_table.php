<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('paper_id')->unsigned();
            $table->integer('genus_id')->unsigned();
            $table->timestamps();

            $table->foreign('paper_id')
              ->references('id')->on('papers');

            $table->foreign('genus_id')
              ->references('id')->on('genera');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('species');
    }
}

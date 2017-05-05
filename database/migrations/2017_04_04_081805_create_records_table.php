<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('recorded_by');
            $table->string('recorded_as')->nullable();
            $table->integer('species_id')->unsigned()->index();
            $table->foreign('species_id')->references('id')->on('species')->onDelete('cascade');
            $table->integer('locality_id')->unsigned()->index();
            $table->foreign('locality_id')->references('id')->on('localities')->onDelete('cascade');
            $table->longText('comments')->nullable();
            $table->integer('males')->nullable();
            $table->integer('females')->nullable();
            $table->integer('juvenile_males')->nullable();
            $table->integer('juvenile_females')->nullable();
            $table->string('collected_by')->nullable();
            $table->timestamp('collected_at')->nullable();
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
        Schema::dropIfExists('records');
    }
}

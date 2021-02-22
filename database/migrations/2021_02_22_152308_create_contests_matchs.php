<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsMatchs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests_matchs', function (Blueprint $table) {
            $table->id();
            $table->string('home');
            $table->string('opponent');
            $table->bigInteger('contest_id')->unsigned()->index();
            $table->foreign('contest_id')->references('id')->on('contests_settings')->onDelete('cascade');
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
        Schema::dropIfExists('contests_matchs');
    }
}

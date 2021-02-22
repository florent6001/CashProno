<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsParticipations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests_participations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('contest_id')->unsigned()->index();
            $table->foreign('contest_id')->references('id')->on('contests_settings')->onDelete('cascade');
            $table->bigInteger('match_id')->unsigned()->index();
            $table->foreign('match_id')->references('id')->on('contests_matchs')->onDelete('cascade');
            $table->integer('prognostic');
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
        Schema::dropIfExists('contests_participations');
    }
}

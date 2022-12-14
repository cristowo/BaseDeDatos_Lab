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
        Schema::create('user_song_restriction_ages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_user')->nullable(); 
            $table->foreign("id_user")->references("id")->on("users");

            $table->unsignedBigInteger('id_song')->nullable(); 
            $table->foreign("id_song")->references("id")->on("songs");

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
        Schema::dropIfExists('user_song_restriction_ages');
    }
};

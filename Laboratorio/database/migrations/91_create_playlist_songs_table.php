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
        Schema::create('playlist_songs', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_playlist')->nullable(); 
            $table->foreign("id_playlist")->references("id")->on("playlists");

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
        Schema::dropIfExists('playlist_songs');
    }
};

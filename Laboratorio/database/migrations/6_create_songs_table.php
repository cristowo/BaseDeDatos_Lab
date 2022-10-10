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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('name',40);
            $table->string('collaborator',100);
            $table->date("date");
            $table->integer("reproduction")->nullable();
            $table->integer("likes")->nullable();
            $table->integer("duration")->nullable();
            $table->text('link');

            $table->boolean("age_restriction")->default(false);

            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign("id_user")->references("id")->on("users");

            $table->unsignedBigInteger('id_country')->nullable();
            $table->foreign("id_country")->references("id")->on("countries");

            $table->unsignedBigInteger('id_genre')->nullable();
            $table->foreign("id_genre")->references("id")->on("genres");
            
            $table->rememberToken();
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
        Schema::dropIfExists('songs');
    }
};

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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer("amount");
            $table->date("date");

            $table->unsignedBigInteger('id_user')->nullable(); 
            $table->foreign("id_user")->references("id")->on("users");

            $table->unsignedBigInteger('id_payment')->nullable(); 
            $table->foreign("id_payment")->references("id")->on("payments");
            
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
        Schema::dropIfExists('tickets');
    }
};

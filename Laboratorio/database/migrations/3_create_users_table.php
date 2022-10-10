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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',80);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',20);
            $table->date("date_of_birth");
            $table->integer("followed")->nullable();
            $table->integer("followers")->nullable();
            $table->boolean("premium")->default(false); 

            $table->unsignedBigInteger('id_rol')->nullable(); 
            $table->foreign("id_rol")->references("id")->on('rols');

            $table->unsignedBigInteger('id_country')->nullable(); 
            $table->foreign("id_country")->references("id")->on('countries');

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
        Schema::dropIfExists('users');
    }
};

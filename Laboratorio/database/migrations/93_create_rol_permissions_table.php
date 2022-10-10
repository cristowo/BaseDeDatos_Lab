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
        Schema::create('rol_permissions', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('id_permission')->nullable(); 
            $table->foreign("id_permission")->references("id")->on("permissions");

            $table->unsignedBigInteger('id_rol')->nullable(); 
            $table->foreign("id_rol")->references("id")->on("rols");
        
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
        Schema::dropIfExists('rol_permissions');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ap');
            $table->string('am');
            $table->integer('ci');
            $table->string('dir');
            $table->integer('cel');
            $table->date('fecnac');
            $table->date('fecin');
            $table->string('email')->unique(); 
            $table->string('password');
            $table->integer('idrol')->unsigned(); 
            $table->integer('idu')->unsigned(); 
            $table->boolean('activo')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('idrol')->references('idrol')->on('rols');
            // $table->foreign('idu')->references('idu')->on('unidads');
            $table->foreign('idu')->references('idambiente')->on('ambientes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

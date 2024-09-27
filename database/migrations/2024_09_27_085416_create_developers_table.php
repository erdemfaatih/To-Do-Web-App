<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('time');
            $table->integer('level');
            $table->string('result')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('developers');
    }

};

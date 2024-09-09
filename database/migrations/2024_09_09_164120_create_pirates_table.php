<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiratesTable extends Migration
{
    public function up()
    {
        Schema::create('pirates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->integer('bounty');
            $table->string('image')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pirates');
    }
}

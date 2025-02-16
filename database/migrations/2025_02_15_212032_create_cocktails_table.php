<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cocktails', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('title');
            $table->string('image')->nullable(); 
            $table->string('glass')->nullable(); 
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cocktails');
    }
};

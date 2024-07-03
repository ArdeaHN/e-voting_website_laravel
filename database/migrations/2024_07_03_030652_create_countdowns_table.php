<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountdownsTable extends Migration
{
    public function up()
    {
        Schema::create('countdowns', function (Blueprint $table) {
            $table->id();
            $table->timestamp('target_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('countdowns');
    }
}
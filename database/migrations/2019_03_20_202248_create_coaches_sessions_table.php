<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoachesSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaches_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('coach_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->timestamps();
        });
    }

    
}

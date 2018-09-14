<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('date');
            $table->string('agent');
            $table->string('source');
            $table->string('link');
            $table->string('niche');
            $table->string('current')->nullable();
            $table->string('description')->nullable();
            $table->string('timing');
            $table->string('budget');
            $table->string('response')->nullable();
            $table->string('status');
            $table->string('execut')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('bids');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('content')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('image_id')->constrained();
            $table->timestamps();

            // metodo constrained() => sustituye el siguiente codigo

            // $table->unsignedBigInteger('user_id');

            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}

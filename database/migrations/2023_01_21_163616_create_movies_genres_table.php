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
        Schema::create('movies_genres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('movies_id')->unsigned();
            $table->unsignedBiginteger('genres_id')->unsigned();

            $table->foreign('movies_id')->references('id')
                 ->on('movies')->onDelete('cascade');
            $table->foreign('genres_id')->references('id')
                ->on('genres')->onDelete('cascade');

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
        Schema::dropIfExists('movies_genres');
    }
};

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
        Schema::create('movies_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBiginteger('movies_id')->unsigned();
            $table->unsignedBiginteger('tags_id')->unsigned();

            $table->foreign('movies_id')->references('id')
                    ->on('movies')->onDelete('cascade');
            $table->foreign('tags_id')->references('id')
                ->on('tags')->onDelete('cascade');

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
        Schema::table('movies_tags', function (Blueprint $table) {
            Schema::dropIfExists('movies_tags');
        });
    }
};

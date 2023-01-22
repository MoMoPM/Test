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
        Schema::create('movies_authors', function (Blueprint $table) {
                $table->id();
                $table->unsignedBiginteger('movies_id')->unsigned();
                $table->unsignedBiginteger('authors_id')->unsigned();
    
                $table->foreign('movies_id')->references('id')
                     ->on('movies')->onDelete('cascade');
                $table->foreign('authors_id')->references('id')
                    ->on('authors')->onDelete('cascade');
    
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
        Schema::table('movies_authors', function (Blueprint $table) {
            Schema::dropIfExists('movies_authors');
        });
    }
};

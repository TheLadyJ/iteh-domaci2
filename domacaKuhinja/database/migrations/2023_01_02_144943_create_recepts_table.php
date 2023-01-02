<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepts', function (Blueprint $table) {
            $table->id();
            $table->string('naziv_recepta');
            $table->string('opis_recepta')->unique();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            $table->foreignId('kategorija_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recepts');
    }
}

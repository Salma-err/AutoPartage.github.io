<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCellosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cellos', function (Blueprint $table) {
            $table->id();
            $table->integer('num');
            $table->integer('version');
            $table->enum('etat',['en stock', 'installé']);
            $table->bigInteger('cello_type_id')->unsigned();
            $table->bigInteger('carte_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cello_type_id')->references('id')->on('cello_types')->onDelete('cascade');
            $table->foreign('carte_id')->references('id')->on('cartes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cellos', function (Blueprint $table){
            $table->dropForeign('cello_type_id');
            $table->dropForeign('carte_id');
            $table->dropColumn('cello_type_id');
            $table->dropColumn('carte_id');
        });
        Schema::dropIfExists('cellos');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->integer('mcu')->unsigned();
            $table->string('matricule')->unique();
            $table->string('marque')->nullable();
            $table->string('modele')->nullable();
            $table->string('type')->nullable();
            $table->string('couleur')->nullable();
            $table->longText('statut')->nullable();
            $table->string('installateur')->nullable();
            $table->dateTime('date_instl');
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('cello_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('cello_id')->references('id')->on('cellos')->onDelete('cascade'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicules', function (Blueprint $table){
            $table->dropForeign('client_id');
            $table->dropForeign('cello_id');
            $table->dropColumn('client_id');
            $table->dropColumn('cello_id');
            $table->dropForeign('user_id');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('vehicules');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehicule_id')->unsigned();
            $table->text('panne');
            $table->enum('etat', ['déclarée', 'en cours de réparation', 'réparée']);
            $table->string('reparateur')->nullable();
            $table->longText('memo_repr')->nullable();
            $table->dateTime('dtDeclr')->nullable();
            $table->dateTime('dtInterv')->nullable();
            $table->dateTime('dtFinInterv')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('vehicule_id')->references('id')->on('vehicules')->onDelete('cascade');
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
        Schema::table('interventions', function (Blueprint $table){
            $table->dropForeign('vehicule_id');
            $table->dropColumn('vehicule_id');
            $table->dropForeign('user_id');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('interventions');
    }
}

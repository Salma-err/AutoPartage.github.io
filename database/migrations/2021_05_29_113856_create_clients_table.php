<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('email')->unique();
            $table->string('tel')->unique();
            $table->string('adresse')->unique();
            $table->bigInteger('client_type_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('client_type_id')->references('id')->on('client_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table){
            $table->dropForeign('client_type_id');
            $table->dropColumn('client_type_id');
        });
        Schema::dropIfExists('clients');
    }
}

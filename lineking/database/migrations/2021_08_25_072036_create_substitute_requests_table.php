<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubstituteRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('substitute_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->integer('maximumCost');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->string('addressName');
            $table->string('latitude');
            $table->string('longitude');
            $table->dateTime('reservedDatetime');
            $table->string('placeName')->nullable();
            $table->string('detailedAddress')->nullable();
            $table->string('detailedMessage')->nullable();
            $table->foreignId('deputy_id')->nullable();
            $table->integer('cost')->nullable();
            $table->enum('type',['requested' ,'reserved', 'completed']);
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
        Schema::dropIfExists('substitute_requests');
    }
}

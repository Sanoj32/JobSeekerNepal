<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('logo')->nullable();
            $table->string('level')->nullable();
            $table->string('vacancy')->nullable();
            $table->string('time')->nullable();
            $table->string('address')->nullable();
            $table->string('salary')->nullable();
            $table->string('deadline')->nullable();
            $table->string('education')->nullable();
            $table->string('experience')->nullable();
            $table->string('skills')->nullable();
            $table->text('desc')->nullable();
            $table->text('desc1')->nullable();
            $table->text('desc2')->nullable();
            $table->text('desc3')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('jobs');
    }
}

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
            $table->string('name');
            $table->string('company');
            $table->string('logo');
            $table->string('level');
            $table->string('vacancy');
            $table->string('time');
            $table->string('address');
            $table->string('salary');
            $table->string('deadline');
            $table->string('education');
            $table->string('experience');
            $table->string('skills');
            $table->text('desc');
            $table->text('desc1');
            $table->text('desc2');
            $table->text('desc3');
            $table->string('url');
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

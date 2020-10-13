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
            $table->string('name')->nullable(); //job name
            $table->string('company')->nullable(); //company name
            $table->string('logo')->nullable(); //company logo
            $table->string('level')->nullable(); //Job level Senior,Mid etc
            $table->string('vacancy')->nullable(); //No of open positions
            $table->string('time')->nullable(); //Full time or part time
            $table->string('address')->nullable(); //Address of the job
            $table->string('salary')->nullable();
            $table->string('deadline')->nullable(); //Application deadline
            $table->string('education')->nullable();
            $table->string('experience')->nullable();
            $table->text('skills')->nullable();
            $table->text('desc')->nullable(); //description of the job
            $table->text('desc1')->nullable();
            $table->text('desc2')->nullable();
            $table->text('desc3')->nullable();
            $table->text('desc4')->nullable();
            $table->string('url')->nullable();
            $table->integer('relevancy')->nullable(); // The relevancy of the search results
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

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
            $table->string('deadline')->nullable(); //Application deadline in string
            $table->date('truedeadline')->nullable(); //Application deadline in Datetime
            $table->string('education')->nullable();
            $table->string('experience')->nullable();
            $table->text('skills')->nullable();
            $table->text('skills1')->nullable();
            $table->text('desct')->nullable();
            $table->text('url')->nullable();
            $table->string('websitename')->nullable();
            $table->integer('relevancy'); // The relevancy of the search results
            $table->boolean('isExpired'); //true means the job is  expired , false means it is not expired
            $table->boolean('isViewed');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('job_category_id');
            $table->integer('job_nature_id');
            $table->date('publish_date');
            $table->date('closing_date');
            $table->string('location');
            $table->integer('acadamic_id');
            $table->string('experiance');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('job_details');
    }
}

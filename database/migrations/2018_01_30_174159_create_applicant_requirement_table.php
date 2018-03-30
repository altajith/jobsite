<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_requirement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('job_category_id');
            $table->integer('job_nature_id');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('applicant_requirement');
    }
}

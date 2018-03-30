<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserTypesDataToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::table('user_types')->insert([
            ['type' => 'Applicant','note' => 'Users who apply for jobs.','created_by' => 0,'updated_by' => 0],
            ['type' => 'Company','note' => 'Users who post jobs.','created_by' => 0,'updated_by' => 0]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

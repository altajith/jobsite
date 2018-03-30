<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $table = "job_users";

    public function job(){
        return $this->hasOne('App\Models\Job\Details','id','job_id');
    }

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
}

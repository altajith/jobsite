<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    protected $table = "job_details";

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function applications(){
        return $this->hasMany('App\Models\Job\Apply','job_id','id');
    }
}

<?php

namespace App\Models\Property;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    protected $table = "property_master";

    public function user_property(){
        return $this->hasOne('App\Models\User\UserProperty','property_id','id');
    }
}

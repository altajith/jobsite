<?php

namespace App\Helpers;

use App\Models\User\UserType;
use App\Models\Job\Details;
use App\Models\Job\Apply;

class Common
{
    public static function getUserTypes(){
        return UserType::orderBy('type')->get();
    }

    public static function buildAdvanceField($type,$value,$id,$note,$class,$selects){
        $id = 'advance_fld_'.$id;
        $html = '<input type="text" value="'.$value.'" name="'.$id.'" id="'.$id.'" placeholder="'.$note.'" class="'.$class.'" />';
        if($type == 'textarea'){
            $html = '<textarea name="'.$id.'" id="'.$id.'" placeholder="'.$note.'" class="'.$class.'">'.$value.'</textarea>';
        }else if($type == 'dropdown'){    
            $options = explode(",",$selects);
            $html = '<select name="'.$id.'" id="'.$id.'" placeholder="'.$note.'" class="'.$class.' chosen-select-no-single">';
            if(is_array($options)){
                foreach($options as $option){
                    $element = explode(":",$option);
                    if(is_array($element) && count($element) == 2){
                        if($value == $element[0]){
                            $html .= '<option value="'.$element[0].'" selected>'.$element[1].'</option>';
                        }else{
                            $html .= '<option value="'.$element[0].'">'.$element[1].'</option>';
                        }
                    }
                }
            }
            $html .= '</select>';
        }else if($type == 'date'){
            $html = '<input type="text" value="'.$value.'" name="'.$id.'" id="'.$id.'" placeholder="'.$note.'" class="'.$class.' date" />';
        }else if($type == 'phone'){
            $html = '<input type="text" value="'.$value.'" name="'.$id.'" id="'.$id.'" placeholder="'.$note.'" class="'.$class.' phone" />';
        }

        return $html;
    }

    public static function applyJob($id,$user){
        $job = Details::find($id);

        if($job){
            $apply = new Apply();
            $apply->job_id = $id;
            $apply->user_id = $user->id;
            $apply->created_by = $user->id;
            $apply->updated_by = $user->id;
            $apply->save();
            return true;
        }else{
            return false;
        }
    }
}

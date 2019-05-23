<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTowns extends Model
{
    public static function townExist($user_id, $townId){
    	$towns = UserTowns::where('user_id',$user_id)
    					->where('town_id',$townId)
    					->first();
    	if($towns){
    		return TRUE;
    	}
    	return FALSE;
    }
}

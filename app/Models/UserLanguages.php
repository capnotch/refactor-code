<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLanguages extends Model
{
    public static function langExist($user_id, $langId){
		 
    	$language = UserLanguages::where('user_id',$user_id)
    					->where('lang_id',$langId)
    					->first();
    	if($language){
    		return TRUE;
    	}
    	return FALSE;
    }
    public static function deleteLang($user_id, $langIds){
			 
        foreach($langIds as $langId){
						$language = UserLanguages::where('user_id',$user_id)
								->where('lang_id',$langId)
							->first();
						if($language){
							$language->delete();

						}
				}	
		return true;			
    }
}

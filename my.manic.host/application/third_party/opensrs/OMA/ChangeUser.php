<?php

// command: change_user
// Create a new user or change the attributes of an existing user. 
class ChangeUser {

	public static function call($data) {
		if (self::validate($data)){
    		return OMA::send_cmd("change_user", $data);
    	}
	}

	// Valdation rule here
    public static function validate($data) {
    	if(empty($data["user"])){
			trigger_error("oSRS Error - User required\n", E_USER_WARNING);	
		} else {
			return true;
		}
  	}
}
?>

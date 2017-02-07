<?php

class Login {
	public static function isloggedin() {
		if (  isset($_COOKIE['SNID'])) {
			if ( DB::query('SELECT user_id from login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])) )){
				$userid=DB::query('SELECT user_id from login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))[0]['user_id'];
				if( isset($_COOKIE['SNID_2'])){

					return $userid;
				} else {

					$cstrong = True;
					$token= bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
					DB::query('INSERT INTO login_tokens VALUES(\'\',:token,:user_id)', array(':token'=>sha1($token),':user_id'=>$userid));
					DB::query('DELETE from login_tokens where token=:token',array(':token'=>sha1($_COOKIE['SNID'])));
					setcookie("SNID", $token , time() + 60 * 60 *24 * 7,'/',NULL,NULL,True);
					setcookie("SNID_2",'1' , time() + 60 * 60 *24 * 3,'/',NULL,NULL,True);

					return $userid;
				}
			}
		}

		return false;
	}

}


?>

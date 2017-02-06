<?php

include('DB.php');


if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$savedpasswd = DB::query('SELECT id,password FROM users where username=:username',array(':username'=>$username))[0]['password'];
	$user_id = DB::query('SELECT id FROM users where username=:username',array(':username'=>$username))[0]['id'];

	if($savedpasswd) {
		if(password_verify($password,$savedpasswd)){
			echo "LOGGED IN";
			$cstrong = True;
			$token= bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
			DB::query('INSERT INTO login_tokens VALUES(\'\',:token,:user_id)', array(':token'=>sha1($token),':user_id'=>$user_id));

			setcookie("SNID", $token , time() + 60 * 60 *24 * 7,'/',NULL,NULL,True);

		}else {
			echo "ERR INVALID PASSWORD";
		}
	} else {
		echo "USER DOES NOT EXISTS";
	}
}

?>


	<h1>Log in to Friends Club</h1>
	<form  class="login.php"  method="post" >
		<input type="text" name="username" value="" placeholder="Username..."> <p />
		<input type="password" name="password" value="" placeholder="Password..."><p />
		<input type="submit" name="login" value="Log In"><p />
	
	</form>


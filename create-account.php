<?php

include('DB.php');


if(isset($_POST['createaccount'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	
	if ( !DB::query('SELECT username FROM users where username=:username',array(':username'=>$username))) {


		if ( strlen($username) >=3 && strlen($username) <=32    ) {
			if (  preg_match('/^[\w]+$/', $username)) {
			DB::query('INSERT INTO users VALUES (\'\',:username,:password,:email)',array(':username'=>$username,':password'=>password_hash($password,PASSWORD_BCRYPT),':email'=>$email));

			echo("SUCCESS");
			} else {
				echo " username can only contain small and large case letters , numbers and underscores";
			}
		} else {
			echo "username must be between 3 and 32 characters";
		}
	} else {

		echo "user exists";

	}


}

?>


	<h1>Register</h1>

	<form  class="create-account.php"  method="post" >
	
		<input type="text" name="username" value="" placeholder="Username..."> <p />
		<input type="password" name="password" value="" placeholder="Password..."><p />
		<input type="email" name="email" value="" placeholder="email..."><p />
		<input type="submit" name="createaccount" value="Create Account"><p />
	
	</form>


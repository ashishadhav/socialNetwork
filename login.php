<?php

include('DB.php');


if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$savedpasswd = DB::query('SELECT password FROM users where username=:username',array(':username'=>$username))[0]['password'];
       
	if($savedpasswd) {
		if(password_verify($password,$savedpasswd)){
			echo "LOGGED IN";
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


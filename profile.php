<?php

include('DB.php');
include('LOG.php');

$username="";
if(isset($_GET['username'] )){
	
	if( DB::query('SELECT username from users where username=:username',array(':username'=>$_GET['username']))) {
		$username = $_GET['username'];
		$user_id = DB::query('SELECT id from users where username=:username',array(':username'=>$_GET['username']))[0]['id'];

		$followerid = Login::isloggedin();	
		$username = $_GET['username'];

		if(isset($_POST['follow'])) {

			$follow = db::query('SELECT follower_id from followers where user_id=:user_id and follower_id=:followerid',array(':user_id'=>$user_id,':followerid'=>$followerid))[0]['follower_id'];
			if ( $follow!=$followerid ) {
			db::query('INSERT INTO followers values (\'\',:userid,:followerid)',array(':userid'=>$user_id,':followerid'=>$followerid ));
			} else {
				echo "ALREADY FOLLOWING";
			}
		}
	} else {
		die("invalid username");
	}
}
?>



<h1> 
	<?php echo $username; ?> 's PROFILE 
</h1>


<form action="profile.php?username=<?php echo $username; ?>" method="post">
	<input type="submit" name="follow"  value="Follow"> 
</form>

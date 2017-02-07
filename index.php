<?php

include('DB.php');
include('LOG.php');


$id=Login::isloggedin();
if ( $id){
	echo "LOGGED IN user ID".$id;
} else {
	echo "NOT LOGGED IN";
}

?>

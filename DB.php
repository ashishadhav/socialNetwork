<?php

class DB {

	private static function connect() {
		try {
			$pdo = new PDO('mysql:host=localhost;dbname=social;charset=utf8mb4','root','zeroarch');
			//$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRORMODE_EXCEPTION);
		} 
		catch(PDOException $e ) {
			print_r(PDO::getAvailableDrivers());
			echo $e->getMessage();
		}
		return $pdo;
	}


	public static function query($query,$params = array()){
		$statement = self::connect()->prepare($query);
		$statement->execute($params);
		//$data = $statement->fetchall();
		//return $data;
	}


}




?>

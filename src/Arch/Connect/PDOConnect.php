<?php

namespace Arch\Connect;

class PDOConnect extends Connect{
	public static $connect;
	
	public static function getConnect($databaseInfo){
		
		if(self::$connect != Null){
                    var_dump('b');
			return self::$connect;
		}
		else{
                    var_dump('a');
			$dn = $databaseInfo['driver'].':host='.$databaseInfo['host'].';dbname='.$databaseInfo['db'];
			self::$connect = new \PDO($dn,$databaseInfo['username'],$databaseInfo['password']);
			return self::$connect;
		}
	}


}

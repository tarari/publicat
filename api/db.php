<?php




function getDB(){
	$dbconf['driver']='mysql';
	$dbconf['dbhost']='localhost';
	$dbconf['dbname']='app';
	$dbconf['dbuser']='app';
	$dbconf['dbpass']='app';
	$dsn=$dbconf['driver'].':host='.$dbconf['dbhost'].';dbname='.$dbconf['dbname'];
	$usr=$dbconf['dbuser'];
	$pwd=$dbconf['dbpass'];
	$conf['dsn']=$dsn;
	$conf['usr']=$usr;
	$conf['pwd']=$pwd;
try{
	
	$dbh=new PDO($conf['dsn'],$conf['usr'],$conf['pwd']);
	}catch(PDOException $e){
		return null;
	}
	return $dbh;
}

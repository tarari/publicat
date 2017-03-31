<?php
	
	require 'vendor/autoload.php';
	require 'config.slim.php';
	require 'db.php';


	\Slim\Slim::registerAutoloader();
	//Configuration
	
	$app = new \Slim\Slim();
	
	$app->get('/hello/:name', 'hello');
	$app->get('/users','getUsers');
	$app->post('/users','createUser');
	$app->post('/users/login','login');
	$app->put('/users/:id','updateUser');
	$app->delete('/users/:id','deleteUser');
	//$app->delete();
	


	$app->run();
	
	function hello ($name=null) {
		if ($name!=null){
    	echo "Hello,".$name;
    	}else echo "Hello";
	}
	function getUsers(){
		$app=\Slim\Slim::getInstance();
		$sql="SELECT * FROM users";
		$dbh=getDB();
		$stmt=$dbh->prepare($sql);
		$stmt->execute();
		$result=$stmt->fetchAll(PDO::FETCH_OBJ);
		$app->response->setStatus(200);
		$app->response->headers->set('Content-Type', 'application/json');
		$dbh=null;
		echo json_encode($result);
		
		
	}
	function existUser($email){
		$sql="SELECT * FROM users WHERE email=:email";
		try{
			$dbh=getDB();
			$stmt=$dbh->prepare($sql);
			$stmt->bindParam(':email',$email);
			$stmt->execute();
			$row=$stmt->rowCount();
			$dbh=null;
			if($row!=1){
				return false;
			}else{
				return true;
			}
		}catch(PDOException $e){
			echo json_encode(array('error'=>$e->getMessage()));
		}
	}

	 function login(){
		$app=\Slim\Slim::getInstance();
	 	$request=$app->request();
	 	$user=$request->params();
	 	$email = $user['email'];
	 	$passw = md5($user['passw']);
	 	$sql="SELECT * FROM users WHERE email=:email AND passw=:passw";
	 	if (!existUser($email)){
	 		$app->response->setStatus(200);
	 		$app->response->headers->set('Content-Type', 'application/json');
	 		echo json_encode(array('error'=>array('text'=>'Usuari inexistent')));
	 	}else{
	 		$dbh=getDB();
			$stmt=$dbh->prepare($sql);
			$stmt->bindParam(':email',$email);
			$stmt->bindParam(':passw',$passw);
			$stmt->execute();
			$row=$stmt->rowCount();
			if($row==1){
			 	$app->response->setStatus(200);
	 	 		$app->response->headers->set('Content-Type', 'application/json');
				echo json_encode(array('red'=>'list'));
			 }else{
			 	$app->response->setStatus(404);
	 			$app->response->headers->set('Content-Type', 'application/json');
			 	echo json_encode(array('error'=>array('text'=>'Password incorrect')));
			 }

	 	}
	// 		$app->response->setStatus(200);
	// 		$app->response->headers->set('Content-Type', 'application/json');
	// 		echo json_encode(array({'error':{'text':'Usuari inexistent'}}));
	// 	}
	 }

	function createUser(){
		$request=\Slim\Slim::getInstance()->request();
		$user=$request->params();
		$username = $user['username'];
		$email = $user['email'];
		$passw = $user['passw'];
		$rol=$user['rol'];
		if (!existUser($email)){
			$sql="INSERT INTO users(username,email,passw,rol) VALUES(:username,:email,:password,:rol)";
			try{
					$dbh=getDB();
					$stmt=$dbh->prepare($sql);
					$stmt->bindParam(':username',$username);
					$stmt->bindParam(':email',$email);
					$stmt->bindParam(':passw',$passw);
					$stmt->bindParam(':rol',$rol);
					$stmt->execute();
					$dbh=null;
					echo json_encode($user);
			}catch(PDOException $e){
				echo json_encode(array('error'=>$e->getMessage()));
			}
		}else{
			echo json_encode(array('msg'=>'User exists'));
		}
		
		
	}

	function updateUser($id){
		$app=\Slim\Slim::getInstance();
		$request=$app->request();
		$user=$request->params();
		try{
		 			$dbh=getDB();
		 			$set="";
					foreach ($user as $key=>$value) {
					  		$set=$set.$key.'=:'.$key.',';
					  		$item[$key]=$value;
					 }

					$set=rtrim($set,",");
					$sql="UPDATE users SET ".$set." WHERE idUser=:id";
					
					$stmt=$dbh->prepare($sql);
					foreach ($item as $key => $value) {
						
					 	$stmt->bindParam( $key,$value);
					 }
					 $stmt->bindParam(':id',$id);
					$stmt->execute();
			 		$dbh=null;
		 		 	$app->response->setStatus(200);
	 	 	 		$app->response->headers->set('Content-Type', 'application/json');
		 		 	echo json_encode(array('msg'=>'User updated'));
		 	}catch(PDOException $e){
		 			$app->response->setStatus(400);
	 				$app->response->headers->set('Content-Type', 'application/json');
		 			echo json_encode(array('error'=>array('text'=>$e->getMessage())));
		 	}
		
		
	}
	function deleteUser($id){
		
	}




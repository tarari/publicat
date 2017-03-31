<?php
	namespace N\App\Models;

	use N\Sys\Model;
	use N\App\Map\User;

	class mHome extends Model{

		function __construct($params){
			parent::__construct($params);
			
		}

		function login($email,$password){
			$sql="SELECT * FROM users WHERE email=:email AND passw=:password";
			$this->query($sql);
			$this->bind(':email',$email);
			$this->bind(':password',$password);
			$this->execute();
			$user=$this->single();
			
			
			//$this->debugDumpParams();
			if($this->rowcount()==1){
				\N\Sys\Session::set('user',new user($user['email'],
				$user['idUser'],
				$user['rol'],
				$user['username']));
				return true;
			}
			else{
				return false;
			}

		}
		
		function extractAdverts(){
			$sql="SELECT * FROM Advertises";
			$this->query($sql);
			$this->execute();
			return $dades=$this->resultSet();

		}
	}
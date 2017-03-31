<?php
	namespace N\App\Models;

	use N\Sys\Model;
	
	class mDashboard extends Model{

		function __construct(){
			parent::__construct();
			
		}
		function extractAdverts(){
			$sql="SELECT * FROM Advertises";
			$this->query($sql);
			$this->execute();
			return $dades=$this->resultSet();

		}
		function listUsers(){
			$sql="SELECT username,email,passw,rol FROM users";
			$this->query($sql);
			$this->execute();
			return $dades=$this->resultSet();
	}


}
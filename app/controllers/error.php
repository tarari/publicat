<?php
	namespace N\App\Controllers;

	use N\Sys\Controller;
	use N\Sys\Registry;
	 
	final class Error extends Controller{
		function __construct($params=null){
			parent::__construct($params);
			$this->conf=Registry::getInstance();

			$this->model=new \N\App\Models\mError;
			$this->view=new \N\App\Views\vError;
		}
		function home(){
			
			
		}
	}
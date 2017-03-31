<?php
	namespace N\App\Views;
	/**
	 *  vHome
	 *  Prepares and loads the corresponding Template
	 *  @author Toni
	 * 
	 * */
	use N\Sys\View;
	use N\Sys\Template;

	class vHome extends View{
		
		function __construct(){
			parent::__construct();
			
			$this->tpl=Template::load('home',$this->view_data);
			


		}

	}
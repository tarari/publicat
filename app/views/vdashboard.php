<?php
	namespace N\App\Views;

	use N\Sys\View;
	use N\Sys\Template;
	/**
	 *  v
	 *  Prepares and loads the corresponding Template
	 *  @author Toni
	 * 
	 * */
	class vDashboard extends View{
		
		function __construct(){
			parent::__construct();
			
			$this->tpl=Template::load('dashboard',$this->view_data);
			

		}

	}
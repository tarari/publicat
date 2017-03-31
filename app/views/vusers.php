<?php
	/**
	 *  vHome
	 *  Prepares and loads the corresponding Template
	 *  @author Toni
	 * 
	 * */
	class vUsers extends View{
		
		function __construct(){
			parent::__construct();
			
			$this->tpl=Template::load('users',$this->view_data);
			
		}

	}
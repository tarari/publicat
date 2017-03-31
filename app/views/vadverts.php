<?php
	/**
	 *  vHome
	 *  Prepares and loads the corresponding Template
	 *  @author Toni
	 * 
	 * */
	class vAdverts extends View{
		
		function __construct(){
			parent::__construct();
			
			$this->tpl=Template::load('adverts',$this->view_data);
			
		}

	}
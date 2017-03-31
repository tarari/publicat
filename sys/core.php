<?php
	namespace N\Sys;
	//require 'sys/request.php';
	/**
	 *  Core: Front Controller
	 *  
	 * @author Toni
	 * @package sys
	 * 
	 * */
	

	class Core{
		static private $controller;
		static private $action;
		static private $params;

		static function init(){
				// begining to extract 
				// routing elements
				Request::retrieve();
				$controller=Request::getCont();
				
				self::$controller=$controller;
				
			
				$action=Request::getAct();
				self::$action=$action;
				
				$params=(array)Request::getParams();
				self::$params=$params;
				
				// routing to the correspondig 
				// controller

				self::router();
			}
			static function router(){
				//Coder::codear(self::$params);
				extract(self::$params);
				//Coder::code($p);
			//redirects Control to respective controller
			$route=(self::$controller!="")?self::$controller:'home';
			$action=(self::$action!="")?self::$action:'home';
			
			

			$fileroute=strtolower($route).'.php';
			//if exists the file controller
			if(is_readable(APP.'controllers'.DS.$fileroute)){
				// create an instance of new controller
				$contr_name='\N\App\Controllers\\'.$route;
				self::$controller=new $contr_name(self::$params);
				$conf=Registry::getInstance();
				$conf->route=$route;
				$conf->action=$action;
				
				//Coder::codear($conf);
				//die;
				if (is_callable(array(self::$controller,$action))){
					//if exists the  method....
					call_user_func(array(self::$controller, $action));
				}
				else{ echo $action.": Unexistent method!";}
			}
			else{
				self::$controller=new \N\App\Controllers\Error;
				
			}
		}
	}
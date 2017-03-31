<?php
	namespace N\Sys;
	class Request{
		static private $query=array();

		static function retrieve(){
			$array_query=explode('/',$_SERVER['REQUEST_URI']);
			//extract the first "/"
			array_shift($array_query);
			// if we publish in root
			
			if (!Helper::is_base()){
				array_shift($array_query);
			}
			//deleting blanks at the end
			if(end($array_query)==""){
				array_pop($array_query);
			}
			//return value to static $query
			self::$query=$array_query;

			//var_dump($array_query);
		}
		static function getCont(){
			return array_shift(self::$query);
		}
		static function getAct(){
			return array_shift(self::$query);
		}
		static function getParams(){
			//primer comprovar que queda algo
			if (count(self::$query)>0){
				//comprovar si és parell
				if((count(self::$query)%2)==0){
					//Coder::codear(self::$query);
					for($i=0;$i<count(self::$query);$i++){
						if(($i%2)==0){
							$key[]=self::$query[$i];
						}else{
							$value[]=self::$query[$i];
						}
					}
					$result=array_combine($key, $value);
					
					return $result;

				}else{
					echo 'ERROR in params array';
				}

			}

		}
	}
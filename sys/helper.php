<?php
	namespace N\Sys;
	

	class Helper{

	
		static function is_base(){
	            if (APP_W!='/'){
	               return false; 
	            }
	            else{
	                return true;
	            }
	        }

	    static function isValidMd5($md5 ='')
	    {
	        return preg_match('/^[a-f0-9]{32}$/', $md5);
	    }

		static function code($var){
			echo '<pre>'.$var.'</pre>';
		}

		static function codear($var){
			echo '<pre>'.var_dump($var).'</pre>';
		}

        static function MenuCreate($menu=array()){
            echo '<ul>';
            foreach ($menu as $item => $link) {
                echo '<a href="'.$link.'"><li>'.$item.'</li></a>';
            }
            echo '</ul>';
        }
 
        static function create($menu=array()){
            echo '<ul>';
            foreach ($menu as $item ) {
                echo '<button type="button">'.$item.'</button>';
            }
            echo '</ul>';
        }
    }





	
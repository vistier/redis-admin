<?php 
		
	function __autoload($class) {
	    require_once 'lib/' . strtolower($class) . '.php';
	}
	
	function getTime($tempo){
		if($tempo>0 AND $tempo<=60){
			$tempo = $tempo."s";
	        }elseif($tempo>60 AND $tempo<=3540){
			$tempo = floor( (($tempo)/60) )."m";
		}elseif($tempo>3540 AND $tempo<=86400){
			$tempo = floor( ((($tempo)/60)/60) )."h";
		}elseif($tempo>86400){
			$tempo = floor( (((($tempo)/60)/60)/24) )."d";
		}
		return $tempo;
	}
	
	function getSize($string){
		if($string>0 AND $string<1024){
			$string = number_format( $string , 1, '.', '.') . " bytes";
	        }elseif($string>=1024 AND $string<1048576){
			$string =  number_format( (($string)/1024) , 1, '.', '.') . " K";
	        }elseif($string>=1048576 AND $string<1073741824){
			$string =  number_format( ((($string)/1024)/1024) , 1, '.', '.') . " M";
	        }elseif($string>=1073741824 AND $string<1099511627776){
			$string =  number_format( (((($string)/1024)/1024)/1024) , 1, '.', '.') . " G";
		}elseif($string>1099511627776){
			$string =  number_format( ((((($string)/1024)/1024)/1024)/1024) , 1, '.', '.') . " T";
		}
		return str_replace(".0 "," ",$string);
	}
	
	function numformat($number){
		return number_format($number , 0, '.', '.');
	}	
?>
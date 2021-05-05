<?php
namespace App\InsuranceAPI\Utils;
use \stdClass;
class PascalAndCamel{
	function fix($request){
		error_log('here');
		$reqString=json_encode($request);
		$request=json_decode($reqString);
		error_log(is_object($request));
		$stdClass=new stdClass();
	
		$vars=get_object_vars($request);
		$ars=array_keys($vars);
		foreach($ars as $key){
			$stdClass=$this->coExistPascalAndCamel($key,$vars[$key],$stdClass);
		}

		return $stdClass;

	}
	function isPascal($key){
		if ( preg_match('~^\p{Lu}~u', $key) ) {
		    return true;
		} else {
    		 	return false;
		}
	}
	function coExistPascalAndCamel($key,$value,$ref){
		
		if(is_object($value)){
			$nval=$this->fix($value);
			$ref->{$key}=$nval;
			if($this->isPascal($key)){
				$nkey=lcfirst($key);
				$ref->{$nkey}=$nval;
			}else{
				$nkey=ucfirst($key);
				$ref->{$nkey}=$nval;
			}
		}else if(is_Array($value)){
                        $arr=array();
			for($i=0; $i < count($value); $i++){
				if(!is_object($value[$i])){
				  $nval=$value[$i];
				}else{
                        	 $nval=$this->fix($value[$i]);
				}
                       		 $arr[$i]=$nval;
				
			}
                                 $ref->{$key}=$arr;
                                 if($this->isPascal($key)){
                                        $nkey=lcfirst($key);
                                        $ref->{$nkey}=$arr;
                                }else{
                                        $nkey=ucfirst($key);
                                        $ref->{$nkey}=$arr;
                                 }
			
		}else{
		   $ref->{$key}=$value;
		   if($this->isPascal($key)){
			$nkey=lcfirst($key);
			$ref->{$nkey}=$value;
		   }else{
			$nkey=ucfirst($key);
			$ref->{$nkey}=$value;
 		   }
			
		}
		return $ref;
	}

}

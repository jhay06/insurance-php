<?php
namespace App\InsuranceAPI;
use App\InsuranceAPI\Models\Request\BaseRequest;
use App\InsuranceAPI\Models\Enums;
use App\InsuranceAPI\Utils\PascalAndCamel;
class InsuranceConnection{
	private $host;
	private $endpoint;
	private $env;
	private $xapikey;
	private $platformkey;
	private $private_key_path;
	function __construct(){
		$insurance=config('insurance')['insurance'];
		$this->env=config('insurance')['environment'];
		$env_var=$insurance[$this->env];
		$this->host=$env_var['host'];
		$this->endpoint=$env_var['endpoint'];
		$this->xapikey=$env_var['xapikey'];
		$this->platformkey=$env_var['platform_key'];
		$this->private_key_path=$env_var['private_key_path'];		
	
	}

	function get_response($request,$requestType){
		$fullurl=$this->host.$this->endpoint;
		error_log($fullurl);
		$curl=curl_init();
		curl_setopt($curl,CURLOPT_URL,$fullurl);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		$header=array('Content-Type:application/json');
		/*
		$header['Authorization']='Bearer ';
		$header['X-API-Key']=$this->xapikey;
		
		*/
		$pascalCamel=new PascalAndCamel();
		$request=$pascalCamel->fix($request);

		$fullrequest=new BaseRequest();
		$fullrequest->ApiKey=$this->platformkey;
		$fullrequest->Request=json_encode($request);
		$fullrequest->RequestType=$requestType;
	
		if($this->env == 'ST'){
			curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
			curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
		}
		curl_setopt($curl,CURLOPT_HTTPHEADER,$header);

		$data=json_encode($fullrequest);
		error_log($data);
		curl_setopt($curl,CURLOPT_COOKIESESSION,true);
		curl_setopt($curl,CURLOPT_POST,1);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
		$res=curl_exec($curl);
		return $res;
		
	}

}


?>

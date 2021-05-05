<?php
namespace App\InsuranceAPI;
use App\InsuranceAPI\Models\Request\BaseRequest;
use App\InsuranceAPI\Models\Enums;
use App\InsuranceAPI\Utils\PascalAndCamel;
use \Firebase\JWT\JWT;
use Illuminate\Support\Facades\Storage;
class InsuranceConnection{
	private $host;
	private $endpoint;
	private $env;
	private $xapikey;
	private $platformkey;
	private $private_key_path;
	private $private_key;
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

	function get_response($request,$requestType,$payload){
		$this->private_key=Storage::get($this->private_key_path);
		$fullurl=$this->host.$this->endpoint;
		error_log($fullurl);
		$curl=curl_init();
		curl_setopt($curl,CURLOPT_URL,$fullurl);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		$token=JWT::encode($payload,$this->private_key,'RS256');
		$header=array('Content-Type:application/json','accept: application/json',
			'Authorization: Bearer '.$token, 'X-API-Key: '.$this->xapikey);
		//$header['Authorization']='Bearer '.$token;
		//$header['X-API-Key']=$this->xapikey;
		error_log(json_encode($header));		
		
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
		curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5000);
		curl_setopt($curl,CURLOPT_TIMEOUT,5000);
		curl_setopt($curl,CURLOPT_COOKIESESSION,true);
		curl_setopt($curl,CURLOPT_POST,1);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
		$res=curl_exec($curl);
		return $res;
		
	}

}


?>

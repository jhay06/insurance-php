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
	function get_response_old($request,$requestType,$payload){
		$this->private_key=Storage::get($this->private_key_path);
		$fullurl=$this->host.$this->endpoint;
		$fullrequest=new BaseRequest();
		$pascalCamel=new PascalAndCamel();
		$fullrequest->ApiKey=$this->platformkey;
		$fullrequest->Request=json_encode($request);
		$fullrequest->RequestType=$requestType;
		$json_request=json_encode($fullrequest);
		$token=JWT::encode($payload,$this->private_key,'RS256');
		$sslArray=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false
			),
			"http"=>array(
				"method"=>"POST",
				"header"=>"Content-Type: application/json;\r\n".
					"Authorization: Bearer ".$token."\r\n".
					"Content-Length: ".strlen($json_request)."\r\n".
					"X-API-Key: ".$this->xapikey."\r\n".
					"User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13",
				"content"=>$json_request
				
			)
		);
		$context=stream_context_create($sslArray);
		$res=file_get_contents($fullurl,false,$context);
		error_log($res);
		return $res;
	}
	function get_response($request,$requestType,$payload){
		$this->private_key=Storage::get($this->private_key_path);
		$fullurl=$this->host.$this->endpoint;
		error_log($fullurl);
		$curl=curl_init();
		$cookies='._cookies.txt';
		curl_setopt($curl,CURLOPT_COOKIEJAR,$cookies);
		curl_setopt($curl,CURLOPT_COOKIEFILE,$cookies);
		curl_setopt($curl,CURLOPT_URL,$fullurl);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		$token=JWT::encode($payload,$this->private_key,'RS256');
		$header=array('Content-Type:application/json','accept: application/json',
			'Authorization: Bearer '.$token, 'X-API-Key: '.$this->xapikey);
		//$header['Authorization']='Bearer '.$token;
		//$header['X-API-Key']=$this->xapikey;
				
		
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

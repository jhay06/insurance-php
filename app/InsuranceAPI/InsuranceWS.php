<?php
namespace App\InsuranceAPI;
use App\InsuranceAPI\Models\Enums\RequestType as InsuranceType;
use App\InsuranceAPI\InsuranceConnection;
use App\InsuranceAPI\Utils\PascalAndCamel;
date_default_timezone_set('Asia/Manila');
class InsuranceWS{
	private $con;
	private $payload;
	function __construct(){
		
		$this->payload=array("AccessDate"=>date('m/d/Y h:i:s'),
		"AppVersion"=>"v1.0",
		"AppName"=>"Multisys Web",
		"IPAddress"=>$_SERVER['REMOTE_ADDR'],
		"MacAddress"=>"");
					
		$this->con=new InsuranceConnection();
	}
	function test_network($request){
		$this->payload["ActionDetail"]="Test Network";
		$res=$this->con->get_response($request,InsuranceType::TestNetwork,$this->payload);
		
		return $this->parseResponse($res);
	}
	function get_category_list($request){
		 $this->payload["ActionDetail"]="Get Category List";
		$res=$this->con->get_response($request,InsuranceType::GetCategoryList,$this->payload);
		return $this->parseResponse($res);
	}
	function get_product_list($request){
		 $this->payload["ActionDetail"]="Get Product List";
		$res=$this->con->get_response($request,InsuranceType::GetProductList,$this->payload);
		return $this->parseResponse($res);
	}
	function get_storage_file($request){
		 $this->payload["ActionDetail"]="Get Product Page/Storage File";
		$res=$this->con->get_response($request,InsuranceType::GetFile,$this->payload);
		return $this->parseResponse($res);
	}
	function search_customer_details($request){
		 $this->payload["ActionDetail"]="Search Customer Details";
		$res=$this->con->get_response($request,InsuranceType::SearchCustomer,$this->payload);
		return $this->parseResponse($res);
	}
	function send_purchase_common($request){
		$this->payload["ActionDetail"]="Purchasing Insurance Product";
		$res=$this->con->get_response($request,InsuranceType::SendPurchase,$this->payload);
		return $this->parseResponse($res);
	}
	function send_purchase_ctpl($request){
		$request['isPaid']=false;
		$request['unit']=1;
		$this->payload["ActionDetail"]="Purchassing Insurance CTPL";
		$res=$this->con->get_response($request,InsuranceType::SendPurchase,$this->payload);
		return $this->parseResponse($res);

	}
	function pay_insurance_common($request){
		$this->payload['ActionDetail']="Tagging Insurance Product as Paid";
		$res=$this->con->get_response($request,InsuranceType::TagInsuranceAsPaid,$this->payload);
		return $this->parseResponse($res);
	}
	function pay_insurance_ctpl($request){
		$request['isCTPL']=true;
		$request['numberOfCOCsPaid']=1;
		$this->payload['ActionDetail']="Tagging CTPL Insurance Product as Paid";
		$res=$this->con->get_response($request,InsuranceType::TagInsuranceAsPaid,$this->payload);
		return $this->parseResponse($res);
	}
	function parseResponse($response){
		
		$obj=json_decode($response);
		$pascalCamel=new PascalAndCamel();
		$stdClass=new \stdClass();
		$vars=get_object_vars($obj);
		$stdClass->ResponseDate=$obj->ResponseDate;
		$stdClass->Result=$pascalCamel->fix(json_decode($obj->Result));
		 
		
		return $stdClass;
	}

}

?>

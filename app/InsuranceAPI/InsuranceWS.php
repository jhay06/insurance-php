<?php
namespace App\InsuranceAPI;
use App\InsuranceAPI\Models\Enums\RequestType as InsuranceType;
use App\InsuranceAPI\InsuranceConnection;
use App\InsuranceAPI\Utils\PascalAndCamel;
class InsuranceWS{
	private $con;
	function __construct(){
		$this->con=new InsuranceConnection();
	}
	function test_network($request){
		$res=$this->con->get_response($request,InsuranceType::TestNetwork);
		
		return $this->parseResponse($res);
	}
	function get_category_list($request){
		$res=$this->con->get_response($request,InsuranceType::GetCategoryList);
		return $this->parseResponse($res);
	}
	function get_product_list($request){
		$res=$this->con->get_response($request,InsuranceType::GetProductList);
		return $this->parseResponse($res);
	}
	function get_storage_file($request){
		$res=$this->con->get_response($request,InsuranceType::GetFile);
		return $this->parseResponse($res);
	}
	function search_customer_details($request){
		$res=$this->con->get_response($request,InsuranceType::SearchCustomer);
		return $this->parseResponse($res);
	}
	function send_purchase($request){
		$res=$this->con->get_response($request,InsuranceType::SendPurchase);
		return $this->parseResponse($res);
	}
	function parseResponse($response){
	
		$obj=json_decode($response);
		$pascalCamel=new PascalAndCamel();
		$stdClass=new \stdClass();
		$vars=get_object_vars($obj);
		$stdClass->ResponseDate=$obj->ResponseDate;
		$stdClass->Result=$pascalCamel->fix(json_decode($obj->Result));
		 
		error_log(json_encode($stdClass));
		return $stdClass;
	}

}

?>

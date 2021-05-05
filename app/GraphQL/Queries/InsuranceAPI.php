<?php

namespace App\GraphQL\Queries;

use App\InsuranceAPI\InsuranceWS;

class InsuranceAPI
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
	function test_network($param,$args){
		$insuranceWS=new InsuranceWS();
		$res=$insuranceWS->test_network($args['input']);
	
		return $res;
	}
	function get_category_list($param,$args){
                $insuranceWS=new InsuranceWS();
                $res=$insuranceWS->get_category_list($args['input']);
               
                return $res;
	}
	function get_product_list($param,$args){
                $insuranceWS=new InsuranceWS();
                $res=$insuranceWS->get_product_list($args['input']);
                
                return $res;
	}
	function get_storage_file($param,$args){
                $insuranceWS=new InsuranceWS();
                $res=$insuranceWS->get_storage_file($args['input']);
                
                return $res;
	}
	function search_customer_details($param,$args){
                $insuranceWS=new InsuranceWS();
                $res=$insuranceWS->search_customer_details($args['input']);
                
                return $res;
	}

}

<?php

namespace App\GraphQL\Mutations;
use App\InsuranceAPI\InsuranceWS;
class InsuranceAPI
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
	function send_purchase_common($param,$args){
		$insurancews=new InsuranceWS();
		$res=$insurancews->send_purchase_common($args['input']);
		
		return $res;
	}
	function send_purchase_ctpl($param,$args){
		$insurancews=new InsuranceWS();
		$res=$insurancews->send_purchase_ctpl($args['input']);
		return $res;
	}
	function pay_insurance_common($param,$args){
		$insurancews=new InsuranceWS();
		$res=$insurancews->pay_insurance_common($args['input']);
		return $res;
	}
	function pay_insurance_ctpl($param,$args){
		$insurancews=new InsuranceWS();
		$res=$insurancews->pay_insurance_ctpl($args['input']);
		return $res;
	}
}

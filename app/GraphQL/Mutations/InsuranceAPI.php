<?php

namespace App\GraphQL\Mutations;
use App\InsuranceAPI\InsuranceWS;
class InsuranceAPI
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
	function send_purchase($param,$args){
		$insurancews=new InsuranceWS();
		$res=$insurancews->send_purchase($args['input']);
		error_log($res);
		return $res;
	}
}

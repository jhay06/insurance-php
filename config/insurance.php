<?php
/*
Author : Jhay Mendoza
Company : Networld Capital Ventures Inc.
Department : Affiliates Software


*/


return [
	'insurance'=>[
		'LOCAL'=>[
			'host'=>'http://jhay.kate.com:57744/',
			'endpoint'=>'InsuranceGateway',
			'xapikey'=>'547fcafd-fd94-4361-beda-3fd7e23887ab',
			'platform_key'=>'24e8378eab8d092d3e5afc4c8658837a',
			'private_key_path'=>''
		],
		'ST'=>[
			'host'=>'https://mno.cebuanalhuillier.com/',
			'endpoint'=>'NCVI/IMSAPI/1.0/InsuranceGateway',
			'xapikey'=>'547fcafd-fd94-4361-beda-3fd7e23887ab',
			'platform_key'=>'24e8378eab8d092d3e5afc4c8658837a',
			'private_key_path'=>'insurance/private.pem'
		],
		'UAT'=>[
			'host'=>'https://abc.cebuanalhuillier.com/',
			'endpoint'=>'NCVI/IMSAPI/1.0/InsuranceGateway',
			'xapikey'=>'Your X-API Key',
			'platform_key'=>'Your Platform key',
			'private_key_path'=>'insurance/private.pem'
		],
		'PROD'=>[
			'host'=>'https://xyz.cebuanalhuillier.com/',
			'endpoint'=>'NCVI/IMSAPI/1.0/InsuranceGateway',
			'xapikey'=>'Your X-API key',
			'platform_key'=>'Your Platform key',
			'private_key_path'=>'insurance/private.pem'
		]
	],
	'environment'=>'ST',
	'version'=>'1.0'
];

?>

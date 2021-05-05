<?php

namespace App\GraphQL\Queries;

class TestGraph
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function test($param,array $args){
	return "It is working";
    }
}

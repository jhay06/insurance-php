<?php

namespace App\GraphQL\Mutations;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
ini_set('memory_limit','-1');
class MutationTest
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function test($rootvalue,array $args,GraphQLContext $context){

	
	
	return "Hello world";
   }
}

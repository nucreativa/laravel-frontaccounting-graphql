<?php

namespace App\GraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Nucreativa\LaravelFrontAccountingModels\SalesOrder;

class SalesOrderQuery extends Query {
	protected $attributes = [
		'name'        => 'SalesOrderQuery',
		'description' => 'A query'
	];

	public function type() {
		return Type::listOf( GraphQL::type( 'SalesOrderType' ) );
	}

	public function args() {
		return [

		];
	}

	public function resolve( $root, $args, $context, ResolveInfo $info ) {
		return SalesOrder::on( 'fa' )->get();
	}
}

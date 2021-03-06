<?php

namespace Nucreativa\LaravelFrontaccountingGraphQL\Query;

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
			'order_no' => [ 'name' => 'order_no', 'type' => Type::string() ],
		];
	}

	public function resolve( $root, $args, $context, ResolveInfo $info ) {
		$salesOrder = SalesOrder::on( 'fa' );
		if ( isset( $args['order_no'] ) ) {
			$salesOrder = $salesOrder->where( 'order_no', $args['order_no'] );
		}

		return $salesOrder->get();
	}
}

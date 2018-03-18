<?php

namespace Nucreativa\LaravelFrontaccountingGraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Nucreativa\LaravelFrontAccountingModels\PurchaseOrder;

class PurchaseOrderQuery extends Query {
	protected $attributes = [
		'name'        => 'PurchaseOrderQuery',
		'description' => 'A query'
	];

	public function type() {
		return Type::listOf( GraphQL::type( 'PurchaseOrderType' ) );
	}

	public function args() {
		return [
			'order_no' => [ 'name' => 'order_no', 'type' => Type::string() ],
		];
	}

	public function resolve( $root, $args, $context, ResolveInfo $info ) {
		$purchaseOrder = PurchaseOrder::on( 'fa' );
		if ( isset( $args['order_no'] ) ) {
			$purchaseOrder = $purchaseOrder->where( 'order_no', $args['order_no'] );
		}

		return $purchaseOrder->get();
	}
}

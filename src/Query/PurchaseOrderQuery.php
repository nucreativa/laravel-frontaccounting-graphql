<?php

namespace App\GraphQL\Query;

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

		];
	}

	public function resolve( $root, $args, $context, ResolveInfo $info ) {
		return PurchaseOrder::on( 'fa' )->get();
	}
}

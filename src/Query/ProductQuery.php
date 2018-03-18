<?php

namespace Nucreativa\LaravelFrontaccountingGraphQL\Query;

use Folklore\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Nucreativa\LaravelFrontAccountingModels\Stock;

class ProductQuery extends Query {
	protected $attributes = [
		'name'        => 'SalesOrderQuery',
		'description' => 'A query'
	];

	public function type() {
		return Type::listOf( GraphQL::type( 'ProductType' ) );
	}

	public function args() {
		return [
			'sku' => [ 'name' => 'sku', 'type' => Type::string() ],
		];
	}

	public function resolve( $root, $args, $context, ResolveInfo $info ) {
		$stock = Stock::on( 'fa' );
		if ( isset( $args['sku'] ) ) {
			$stock = $stock->where( 'stock_id', $args['sku'] );
		}

		return $stock->get();
	}
}

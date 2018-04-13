<?php

namespace Nucreativa\LaravelFrontaccountingGraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class ProductPriceType extends BaseType {
	protected $attributes = [
		'name'        => 'ProductPrice',
		'description' => 'A type'
	];

	public function fields() {
		return [
			'id'         => [
				'type'        => Type::string(),
				'description' => 'The id of the product price'
			],
			'sku'        => [
				'type'        => Type::string(),
				'description' => 'The sku of the product price'
			],
			'type'       => [
				'type'        => Type::string(),
				'description' => 'The type of the product price'
			],
			'sales_type' => [
				'type'        => GraphQL::type( 'SalesOrderType' ),
				'description' => 'The type id of the product price'
			],
			'price'      => [
				'type'        => Type::float(),
				'description' => 'The price of the product price'
			]
		];
	}

	protected function resolveSkuField( $root, $args ) {
		return $root->stock_id;
	}

	protected function resolveTypeField( $root, $args ) {
		return $root->type->sales_type;
	}

	protected function resolveSalesTypeField( $root, $args ) {
		return $root->type;
	}
}

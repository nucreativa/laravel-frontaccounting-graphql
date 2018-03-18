<?php

namespace Nucreativa\LaravelFrontaccountingGraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class ProductType extends BaseType {
	protected $attributes = [
		'name'        => 'ProductType',
		'description' => 'A type'
	];

	public function fields() {
		return [
			'sku'                => [
				'type'        => Type::string(),
				'description' => 'The sku of the product'
			],
			'description'        => [
				'type'        => Type::string(),
				'description' => 'The description of the product'
			],
			'long_description'   => [
				'type'        => Type::string(),
				'description' => 'The long description of the product'
			],
			'units'              => [
				'type'        => Type::string(),
				'description' => 'The units of the product'
			],
			'category'           => [
				'type'        => GraphQL::type( 'ProductCategoryType' ),
				'description' => 'The category of the product'
			],
			'inactive'           => [
				'type'        => Type::boolean(),
				'description' => 'The bool inactive of the product'
			],
			'no_sale'            => [
				'type'        => Type::boolean(),
				'description' => 'The bool no_sale of the product'
			],
			'no_purchase'        => [
				'type'        => Type::boolean(),
				'description' => 'The bool no_purchase of the product'
			],
			'editable'           => [
				'type'        => Type::boolean(),
				'description' => 'The bool editable of the product'
			],
			'sales_account'      => [
				'type' => Type::string(),
			],
			'cogs_account'       => [
				'type' => Type::string(),
			],
			'inventory_account'  => [
				'type' => Type::string(),
			],
			'adjustment_account' => [
				'type' => Type::string(),
			],
			'wip_account'        => [
				'type' => Type::string(),
			],
		];
	}

	protected function resolveSkuField( $root, $args ) {
		return $root->stock_id;
	}
}

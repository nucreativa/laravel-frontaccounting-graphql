<?php

namespace Nucreativa\LaravelFrontaccountingGraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class ProductCategoryType extends BaseType {
	protected $attributes = [
		'name'        => 'ProductCategoryType',
		'description' => 'A type'
	];

	public function fields() {
		return [
			'description'      => [
				'type'        => Type::string(),
				'description' => 'The description of the product category'
			],
			'units'            => [
				'type'        => Type::string(),
				'description' => 'The units of the product category'
			],
		];
	}

	protected function resolveUnitsField( $root, $args ) {
		return $root->dflt_units;
	}
}

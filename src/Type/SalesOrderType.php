<?php

namespace Nucreativa\LaravelFrontaccountingGraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class SalesOrderType extends BaseType {
	protected $attributes = [
		'name'        => 'SalesOrderType',
		'description' => 'A type'
	];

	public function fields() {
		return [
			'id'   => [
				'type' => Type::string(),
			],
			'sales_type'   => [
				'type' => Type::string(),
			],
			'tax_included' => [
				'type' => Type::int(),
			],
			'factor'       => [
				'type' => Type::float(),
			],
			'inactive'     => [
				'type' => Type::boolean(),
			],
		];
	}
}

<?php

namespace App\GraphQL\Type;

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
			'order_no'     => [
				'type'        => Type::nonNull( Type::string() ),
				'description' => 'The order no of the sales order'
			],
			'total_amount' => [
				'type'        => Type::float(),
				'description' => 'The total of the sales order'
			],
			'order_date'   => [
				'type'        => Type::string(),
				'description' => 'The date of the sales order'
			],
			'details'      => [
				'type'        => Type::listOf( GraphQL::type( 'SalesOrderDetailsType' ) ),
				'description' => 'The details of the sales order'
			],
		];
	}

	protected function resolveTotalAmountField( $root, $args ) {
		return $root->total;
	}

	protected function resolveOrderDateField( $root, $args ) {
		return $root->ord_date;
	}
}

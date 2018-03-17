<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class SalesOrderDetailsType extends BaseType
{
    protected $attributes = [
        'name' => 'SalesOrderDetailsType',
        'description' => 'A type'
    ];

    public function fields()
    {
	    return [
		    'sku'     => [
			    'type'        => Type::string(),
			    'description' => 'The sku of the sales order item'
		    ],
		    'description'     => [
			    'type'        => Type::string(),
			    'description' => 'The description of the sales order item'
		    ],
		    'unit_price' => [
			    'type'        => Type::float(),
			    'description' => 'The unit price of the sales order item'
		    ],
		    'quantity'   => [
			    'type'        => Type::int(),
			    'description' => 'The quantity of the sales order item'
		    ],
		    'quantity_sent'   => [
			    'type'        => Type::int(),
			    'description' => 'The quantity sent of the sales order item'
		    ],
	    ];
    }

	protected function resolveSkuField( $root, $args ) {
		return $root->stk_code;
	}

	protected function resolveQuantitySentField( $root, $args ) {
		return $root->qty_sent;
	}
}

<?php

namespace Nucreativa\LaravelFrontaccountingGraphQL\Mutation;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Nucreativa\LaravelFrontAccountingModels\Stock;
use Nucreativa\LaravelFrontAccountingModels\SysPrefs;

/**
 * Class CreateProduct
 * @package Nucreativa\LaravelFrontaccountingGraphQL\Mutation
 * @author Ary Wibowo (nucreativa@gmail.com)
 */
class CreateProduct extends Mutation {
	protected $attributes = [
		'name'        => 'CreateProduct',
		'description' => 'A mutation for create a product'
	];

	public function type() {
		return GraphQL::type( 'ProductType' );
	}

	public function args() {
		return [
			'stock_id'            => [
				'name'  => 'stock_id',
				'type'  => Type::string(),
				'rules' => [ 'required' ]
			],
			'category_id'         => [
				'name'  => 'category_id',
				'type'  => Type::int(),
				'rules' => [ 'required' ]
			],
			'tax_type_id'         => [
				'name'  => 'tax_type_id',
				'type'  => Type::int(),
				'rules' => [ 'required' ]
			],
			'description'         => [
				'name'  => 'description',
				'type'  => Type::string(),
				'rules' => [ 'required' ]
			],
			'long_description'    => [
				'name' => 'long_description',
				'type' => Type::string(),
			],
			'units'               => [
				'name' => 'units',
				'type' => Type::string(),
			],
			'mb_flag'             => [
				'name' => 'mb_flag',
				'type' => Type::string(),
			],
			'sales_account'       => [
				'name' => 'sales_account',
				'type' => Type::string(),
			],
			'cogs_account'        => [
				'name' => 'cogs_account',
				'type' => Type::string(),
			],
			'inventory_account'   => [
				'name' => 'inventory_account',
				'type' => Type::string(),
			],
			'adjustment_account'  => [
				'name' => 'adjustment_account',
				'type' => Type::string(),
			],
			'wip_account'         => [
				'name' => 'wip_account',
				'type' => Type::string(),
			],
			'dimension_id'        => [
				'name' => 'dimension_id',
				'type' => Type::int(),
			],
			'dimension2_id'       => [
				'name' => 'dimension2_id',
				'type' => Type::int(),
			],
			'purchase_cost'       => [
				'name' => 'purchase_cost',
				'type' => Type::float(),
			],
			'material_cost'       => [
				'name' => 'material_cost',
				'type' => Type::float(),
			],
			'labour_cost'         => [
				'name' => 'labour_cost',
				'type' => Type::float(),
			],
			'overhead_cost'       => [
				'name' => 'overhead_cost',
				'type' => Type::float(),
			],
			'inactive'            => [
				'name' => 'inactive',
				'type' => Type::int(),
			],
			'no_sale'             => [
				'name' => 'no_sale',
				'type' => Type::int(),
			],
			'no_purchase'         => [
				'name' => 'no_purchase',
				'type' => Type::int(),
			],
			'editable'            => [
				'name' => 'editable',
				'type' => Type::int(),
			],
			'depreciation_method' => [
				'name' => 'depreciation_method',
				'type' => Type::string(),
			],
			'depreciation_rate'   => [
				'name' => 'depreciation_rate',
				'type' => Type::float(),
			],
			'depreciation_factor' => [
				'name' => 'depreciation_factor',
				'type' => Type::float(),
			],
			'depreciation_start'  => [
				'name' => 'depreciation_start',
				'type' => Type::string(),
			],
			'depreciation_date'   => [
				'name' => 'depreciation_date',
				'type' => Type::string(),
			],
			'fa_class_id'         => [
				'name' => 'fa_class_id',
				'type' => Type::string(),
			],
		];
	}

	public function resolve( $root, $args, $context, ResolveInfo $info ) {
		$conf     = [];
		$sysprefs = SysPrefs::on( 'fa' )->items()->get();
		foreach ( $sysprefs as $syspref ) {
			$conf[ $syspref->name ] = $syspref->value;
		}

		try {
			$product = new Stock();
			$product->setConnection( 'fa' );
			$product->stock_id            = $args['stock_id'];
			$product->category_id         = $args['category_id'];
			$product->tax_type_id         = $args['tax_type_id'];
			$product->description         = $args['description'];
			$product->long_description    = $args['long_description'] ?? '';
			$product->units               = $args['units'] ?? 'each';
			$product->mb_flag             = $args['mb_flag'] ?? 'B';
			$product->sales_account       = $args['sales_account'] ?? $conf['default_inv_sales_act'];
			$product->cogs_account        = $args['cogs_account'] ?? $conf['default_cogs_act'];
			$product->inventory_account   = $args['inventory_account'] ?? $conf['default_inventory_act'];
			$product->adjustment_account  = $args['adjustment_account'] ?? $conf['default_adj_act'];
			$product->wip_account         = $args['wip_account'] ?? $conf['default_wip_act'];
			$product->dimension_id        = $args['dimension_id'] ?? 0;
			$product->dimension2_id       = $args['dimension2_id'] ?? 0;
			$product->purchase_cost       = $args['purchase_cost'] ?? 0;
			$product->material_cost       = $args['material_cost'] ?? 0;
			$product->labour_cost         = $args['labour_cost'] ?? 0;
			$product->overhead_cost       = $args['overhead_cost'] ?? 0;
			$product->inactive            = $args['inactive'] ?? 0;
			$product->no_sale             = $args['no_sale'] ?? 0;
			$product->no_purchase         = $args['no_purchase'] ?? 0;
			$product->editable            = $args['editable'] ?? 0;
			$product->depreciation_method = $args['depreciation_method'] ?? 'S';
			$product->depreciation_rate   = $args['depreciation_rate'] ?? 0;
			$product->depreciation_factor = $args['depreciation_factor'] ?? 0;
			$product->depreciation_start  = $args['depreciation_start'] ?? null;
			$product->depreciation_date   = $args['depreciation_date'] ?? null;
			$product->fa_class_id         = $args['fa_class_id'] ?? '';
			$product->save();

			return $product;
		} catch ( \Exception $e ) {
			echo $e->getMessage();
		}
	}
}

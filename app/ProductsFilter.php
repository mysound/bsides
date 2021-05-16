<?php

namespace App;
use App\Count;

class ProductsFilter extends QueryFilter
{
	public function searchField($value)
	{
		$this->builder->where('name', 'LIKE', '%' . $value. '%')
						->orwhere('title', 'LIKE', '%' . $value. '%')
						->orwhere('upc', $value);
	}

	public function noImg($value)
	{
		if($value) {
			$this->builder->doesntHave('images');
		}
	}

	public function sortPrice($value)
	{
		$this->builder->orderBy('price', $value);
	}

	public function sortViews($value)
	{
		$this->builder->orderBy(Count::select('view_count')
			->whereColumn('counts.product_id', 'products.id'), $value
		);
	}

	public function sortCart($value)
	{
		$this->builder->orderBy(Count::select('cart_count')
			->whereColumn('counts.product_id', 'products.id'), $value
		);
	}

	public function sortQty($value)
	{
		$this->builder->orderBy('quantity', $value);
	}
}
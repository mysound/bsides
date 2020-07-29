<?php

// Store
Breadcrumbs::for('store', function ($trail) {    
	$trail->push('Магазин', route('store'));
});

// Store > SearchField
Breadcrumbs::for('store.searchfield', function ($trail, $searchfield) {    
    $trail->parent('store');
    $trail->push(ucwords(str_replace('-', ' ', $searchfield)), route('store', $searchfield));
});

// Store > Collection
Breadcrumbs::for('porductname', function ($trail, $category = null, $porductname) {
	$trail->parent('store');
	$trail->push(ucwords(str_replace('-', ' ', $porductname)), route('porductname', $porductname));
});

// Store > Ganre
Breadcrumbs::for('store.ganre', function ($trail, $ganreslug) {
	$trail->parent('store');
    $trail->push('жанр: '.ucwords(str_replace('-', ' ', $ganreslug)), route('store.ganre', $ganreslug));
});

// Store > Category
Breadcrumbs::for('category', function ($trail, $slug, $searchField) {
	$category = App\Category::where('slug', $slug)->first();
    if(is_null($searchField)) {
    	$trail->parent('store');
    	$trail->push($category->title, route('category', $slug));
    } else {
    	$trail->parent('category', $slug, null);
    	$trail->push(ucwords(str_replace('-', ' ', $searchField)), route('category', $slug));
    }
});

// Store > Newproducts
Breadcrumbs::for('newproducts', function ($trail) {
    $trail->parent('store');
    $trail->push('Новинки', route('store'));
});

// Store > Preorder
Breadcrumbs::for('preorder', function ($trail) {
    $trail->parent('store');
    $trail->push('Предзаказ', route('store'));
});

// Store > Boxset
Breadcrumbs::for('boxset', function ($trail) {
    $trail->parent('store');
    $trail->push('Бокс-сеты', route('store'));
});
<?php

class DefaultController extends BaseController {

	protected $layout = 'layouts.default';

	public function index()
	{
		$products = Product::all();
		$this->layout->content = View::make('default.index', compact('products'));
	}

	public function product($id)
	{
		$product = Product::find($id);
		$this->layout->content = View::make('default.product', compact('product'));
	}

}
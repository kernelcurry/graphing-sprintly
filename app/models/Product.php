<?php

class Product extends Eloquent {

	protected $table = 'products';

	public function snapshots()
	{
		return $this->hasMany('Snapshot');
	}

}
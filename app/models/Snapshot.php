<?php

class Snapshot extends Eloquent {

	protected $table = 'snapshots';

	public function product()
	{
		return $this->belongsTo('Product');
	}

	public function current_total() {
		$small = $this->current_s * Config::get('sprintly.s');
		$medium = $this->current_m * Config::get('sprintly.m');
		$large = $this->current_l * Config::get('sprintly.l');
		$extra_large = $this->current_xl * Config::get('sprintly.xl');
		return $small + $medium + $large + $extra_large;
	}

	public function backlog_total() {
		$small = $this->backlog_s * Config::get('sprintly.s');
		$medium = $this->backlog_m * Config::get('sprintly.m');
		$large = $this->backlog_l * Config::get('sprintly.l');
		$extra_large = $this->backlog_xl * Config::get('sprintly.xl');
		return $small + $medium + $large + $extra_large;
	}

}
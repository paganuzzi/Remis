<?php
class Sms extends Eloquent{

	protected $table = 'sms';

	public function scopeSmsnoleidos($query){
		return $query->where('para','=',Auth::user()->id)->where('leido','=',0)->get();
	}
}

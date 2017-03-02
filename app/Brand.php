<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name','description'];

 	/**
   * [$hidden description]
   * @var [type]
   */
 	protected $hidden = ['created_at'];

	/**
	 * Mutator - Setea la primera letra de cada palabra a mayuscula
	 * @var String
	 */
	public function setNameAttribute($value) {

		$this->attributes['name'] = ucfirst(strtolower($value));
	}
}

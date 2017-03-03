<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model {

	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];

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

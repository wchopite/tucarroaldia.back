<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleModel extends Model {

	use softDeletes;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'models';

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
	protected $fillable = ['name','brand_id','description'];

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

	/**
	 * Relacion N:1 con marcas de vehiculos
	 */
	public function brand() {

		return $this->belongsTo('App\Brand');
	}
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleModelRequest extends FormRequest {

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {

    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {

    // regla de validacion para el campo nombre cuando el metodo es POST
    $name_validation = 'required|unique:models|min: 3|max:80';

    // regla de validacion para el campo brand_id
    $brand_id = 'required|integer';

    // Validation rule for field name on action update
    if($this->method() == "PUT" || $this->method() == "PATCH") {

      // regla de validacion para el campo nombre cuando el metodo es PUT o PATCH
      $name_validation = 'required|min: 3|max:80|unique:models,name,'.$this->model;
    }

    return [
      'name' => $name_validation,
      'brand_id' => $brand_id
    ];
  }

  /**
   * Mensajes para las reglas de validacion
   *
   * @return [array] Mensaje para cada regla de validacion de cada campo
   */
  public function messages() {
    return [
      'name.required' => 'Debe indicar el nombre del modelo',
      'name.unique' => 'El nombre indicado ya se encuentra registrado',
      'name.min' => 'El nombre debe contener al menos 3 caracteres',
      'name.max' => 'El nombre no puede contener mas de 80 caracteres',
      'brand_id.required' => 'Debe indicar la marca asociada',
      'brand_id.integer' => 'La marca debe ser un valor entero'
    ];
  }
}

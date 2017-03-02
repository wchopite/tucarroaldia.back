<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest {

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    
    return true;
  }

  /**
   * Reglas de validacion aplicada al Request
   *
   * @return array
   */
  public function rules(){

    // regla de validacion para el campo nombre cuando el metodo es POST
    $name_validation = 'required|unique:brands|min: 3|max:60';

    // Validation rule for field name on action update
    if($this->method() == "PUT" || $this->method() == "PATCH") {

      // regla de validacion para el campo nombre cuando el metodo es PUT o PATCH
      $name_validation = 'required|min: 3|max:60|unique:brands,name,'.$this->brand.'';
    }

    return [
      'name' => $name_validation
    ];
  }

  /**
   * Mensajes para las reglas de validacion
   *
   * @return [array] Mensaje para cada regla de validacion de cada campo
   */
  public function messages() {
    return [
      'name.required' => 'Debe indicar el nombre de la marca',
      'name.unique' => 'El nombre indicado ya se encuentra registrado',
      'name.min' => 'El nombre debe contener al menos 3 caracteres',
      'name.max' => 'El nombre no puede contener mas de 60 caracteres'
    ];
  }
}

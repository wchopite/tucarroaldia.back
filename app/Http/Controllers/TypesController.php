<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Http\Requests\TypeRequest;

class TypesController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {

    $types = Type::orderBy('name','asc')->get();
    return response()->json($types);
  }

  /**
   * Display a list of types soft deleted.
   *
   * @return \Illuminate\Http\Response
   */
  public function trashed() {

    $trashedTypes = Type::onlyTrashed()->get();
    return response()->json($trashedTypes);
  }

  /**
   * Restore a type soft deleted.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function restore($id) {

    $type = Type::withTrashed()->where('id', $id)->first();
    $type->restore();
    return response()->json($type);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(TypeRequest $request) {

    $type = new Type($request->all());
    $type->save();
    return response()->json($type);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {

    $type = Type::find($id);

    if(is_null($type))
      return response()->json("Registro no encontrado",404);
    else
      return response()->json($type);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(TypeRequest $request, $id) {

    $type = Type::find($id);

    if(is_null($type))
      return response()->json("Registro no encontrado", 404);
    else {

      $type->update($request->all());
      return response()->json($type);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {

    $type = Type::find($id);

    if(is_null($type))
      return response()->json("Registro no encontrado", 404);
    else {
      $type->delete();
      return response()->json("Registro eliminado satisfactoriamente");
    }
  }
}

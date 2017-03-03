<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VehicleModel;
use App\Http\Requests\VehicleModelRequest;

class VehicleModelsController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {

    $models = VehicleModel::orderBy('name','asc')->get();
    return response()->json($models);
  }

  /**
   * Display a list of models soft deleted.
   *
   * @return \Illuminate\Http\Response
   */
  public function trashed() {

    $trashedModels = VehicleModel::onlyTrashed()->get();
    return response()->json($trashedModels);
  }

  /**
   * Restore a model soft deleted.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function restore($id) {

    $model = VehicleModel::withTrashed()->where('id', $id)->first();
    $model->restore();
    return response()->json($model);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(VehicleModelRequest $request) {

    $model = new VehicleModel($request->all());
    $model->save();
    return response()->json($model);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {

    $model = VehicleModel::find($id)
      ->with(['brand' => function ($query) {
        $query->select('id','name');
      }])
      ->first();

    if(is_null($model))
      return response()->json('Registro no encontrado', 404);
    else
      return response()->json($model);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {

    $model = VehicleModel::find($id);

    if(is_null($model)) {
      return response()->json('Registro no encontrado', 404);
    }
    else {
      $model->update($request->all());
      return response()->json($model);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {

    $model = VehicleModel::find($id);

    if(is_null($model)){
      return response()->json('Registro no encontrado', 404);
    }
    else {
      $model->delete();
      return response()->json("Registro eliminado satisfactoriamente");
    }
  }
}

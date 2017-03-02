<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests\BrandRequest;

class BrandsController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {

    $brands = Brand::orderBy('name','asc')->get();
    return response()->json($brands);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() { }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(BrandRequest $request) {

    $brand = new Brand($request->all());
    $brand->save();
    return response()->json($brand);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {

    $brand = Brand::find($id);

    if(is_null($brand))
      return response()->json("Registro no encontrado", 404);
    else
      return response()->json($brand);

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) { }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(BrandRequest $request, $id) {
    
    $brand = Brand::find($id);

    if(is_null($brand)) {
      return response()->json('Registro no encontrado', 404);
    }
    else {
      $brand->update($request->all());
      return response()->json($brand);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {

    $brand = Brand::find($id);

    if(is_null($brand)){
      return response()->json('Registro no encontrado', 404);
    }
    else {
      $brand->delete();
      return response()->json("Registro eliminado satisfactoriamente");
    }
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests\BrandRequest;

class BrandsController extends Controller {

  /**
   * Display a listing of brands.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {

    $brands = Brand::orderBy('name','asc')->get();
    return response()->json($brands);
  }

  /**
   * Display a list of brands soft deleted.
   *
   * @return \Illuminate\Http\Response
   */
  public function trashed() {

    $trashedBrands = Brand::onlyTrashed()->get();
    return response()->json($trashedBrands);
  }

  /**
   * Restore a brand soft deleted.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function restore($id) {

    $brand = Brand::withTrashed()->where('id', $id)->first();
    $brand->restore();
    return response()->json($brand);
  }

  /**
   * Store a newly brand in storage.
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
   * Display the specified brand.
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
   * Update the specified brand in storage.
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
   * Remove the specified brand from storage.
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

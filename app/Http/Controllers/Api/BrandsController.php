<?php

namespace App\Http\Controllers\Api;

use App\Brands;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Response;

class BrandsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBrands(){
        
     
      $all_brands = Brands::join('items', 'brands.id', '=', 'items.brands_id')->where('brands.active',1)->
              select('brands.id','brands.image')->get();

             return response()->json(['msg' => 'success', 'status' => true, 'result' => $all_brands], 200);

    }
        public function get_status(){
        
     
      $all_status = Status::where('active',1)->get();

             return response()->json(['msg' => 'success', 'status' => true, 'result' => $all_status], 200);

    }

    


 


}

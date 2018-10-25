<?php

namespace App\Http\Controllers\Api;

use App\Categories;
use App\Sub_categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Response;
use App\Items;
use App\Banners;





use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use Validator;
use File;

class CategoriesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_cat() {


        $all_categories = Categories::where('active', 1)->get();
//            return Response::json(array(
//          'status'=>true,
//          'message' => 'success',
//            'result' => $all_categories),
//            200
//        );
        return response()->json(['message' => 'success', 'status' => true, 'result' => $all_categories], 200);
    }

    public function get_sub_cat(Request $request) {
        // dd($request->input('category_id'));
        $category_id = $request->input('CategoryID');
        //  if(!empty($category_id)){
        $all_sub_categories = Sub_categories::where('categories_id', $category_id)->where('active', 1)->get();
//        return Response::json(array(
//            'status'=>TRUE,
//            'message'=>'success',
//            'result'=> $all_sub_categories
//        ),200);

        return response()->json(['message' => 'success', 'status' => true, 'result' => $all_sub_categories], 200);
        //   }
    }
    public function homeCategory($lang = 'ar'){
           $all_categories = Categories::where('categories.active', 1)->select('categories.id','categories.'.$lang.'_title as name')
                   ->join('sub_categories', 'sub_categories.categories_id', '=', 'categories.id')->distinct()->get();
   foreach ($all_categories as $row){
       $row->sub_category=Sub_categories::join('items', 'sub_categories.id', '=', 'items.sub_categories_id')
               ->where('sub_categories.categories_id',$row->id)->where('sub_categories.active', 1)->select('sub_categories.id','sub_categories.'.$lang.'_title as name',DB::raw('count(*) as total'))
                 ->groupBy('sub_categories.id')
               ->get();
   }
      return response()->json(['message' => 'Successfully', 'status' => true, 'result' => $all_categories], 200);
        
    }
    public function homeBaner($lang = 'ar'){
   
        $all_banner=Banners::where('banners.active', 1)->select('banners.id','banners.image')->get();
          return response()->json(['message' => 'Successfully', 'status' => true, 'result' => $all_banner], 200);
    }



}

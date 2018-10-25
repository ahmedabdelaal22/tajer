<?php

namespace App\Http\Controllers\Api;

use App\Items;
use App\Reviews;
use App\Wishlist;
use App\Item_images;
use App\Sub_categories;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Response;
use Carbon\Carbon;
use App\Cart;
use Validator;
use File;

class ItemsController extends Controller {

 public function itemsCategory($lang='ar'){
    $user_id= request('UserID');
     $ofset=(request('ofset')) ? request('ofset'):0;
     $limit=40;
     $ofset=$ofset*$limit;
  $wishlists=array();
    if(!empty($user_id)){
        $wishlists1= Wishlist::where('user_id',$user_id)->select('items_id')->get();
             $i = 0;
            foreach ($wishlists1 as $row) {
                $wishlists[$i] = $row->items_id;
                $i++;
            }
         $wishlists = ($wishlists) ? $wishlists : array();
   }
   $items_query=Items::where('items.active',1);
           if(request('CategoryID')){
               $items_query->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')->
                       join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                       ->where('categories.id',request('CategoryID'));
           }
              if(request('sub_CategoryID')>0){
               $items_query->where('items.sub_categories_id',request('sub_CategoryID'));
           }
           
             if(request('Low_Price')>=0 && request('High_Price') > 0 ){
           $items_query->whereBetween('items.discount_price', [request('Low_Price'), request('High_Price')]);
             }
               if(request('Kye_Word') ){
               $items_query->where('items.title', 'like', '%' . request('Kye_Word') . '%');

             }
             $colors1=request('colors');//is_array
          

        // $colors=[74,84];
                 if ($colors1 ) {
                     $colors= explode(',', $colors1);
                    $colors1=array();
                     for($i=0;$i < count($colors);$i++){
                         $colors1[$i]= intval($colors[$i]);
                     }
            
                  if(count($colors1)>0){
            $items_query->join('items_colors', 'items.id', '=', 'items_colors.item_id')
                       ->join('colors', 'items_colors.color_id', '=', 'colors.id')
                    ->whereIn('colors.id',$colors1);
                  }
        }
         $sizes12=request('sizes');
          if ($sizes12 ) {
                     $sizes= explode(',', $sizes12);
                    $sizes12=array();
                     for($i=0;$i < count($sizes);$i++){
                         $sizes12[$i]= intval($sizes[$i]);
                     }
                    
                  if(count($sizes12)>0){
            $items_query->join('items_sizes', 'items.id', '=', 'items_sizes.item_id')
            ->where(function($query) use ($sizes12){
             
        return $query->where('items_sizes.size', $sizes12[0]);
                for($i=1;$i<count($sizes12);$i++){
            $query->orWhere('items_sizes.size', $sizes12[$i]);
                }
                    });

                     }
          }

               $items = $items_query->select('items.id','items.title','items.thumbnail_image as image','items.discount_price as price')
                       ->skip($ofset)->take($limit)->get();
     
      foreach ($items as $row){
              if (in_array($row->id , $wishlists)) {
              $row->is_favorite = 1;
            } else {
                $row->is_favorite= 0;
            }
            
        }
        
        
        //colot cat
             $all_colors = DB::table('items_colors')
                        ->join('colors', 'colors.id', '=', 'items_colors.color_id')
                        ->join('items', 'items.id', '=', 'items_colors.item_id')
                        ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                        ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                        ->where('colors.active', '1')
                        ->where('sub_categories.id', request('sub_CategoryID'))
                        ->select('colors.' . $lang . '_name as title', 'colors.id as id', DB::raw('count(*) as total'))
                        ->groupBy('colors.id')
                        ->distinct()->get();
                $all_sizes = DB::table('items_sizes')
                       
                        ->join('items', 'items.id', '=', 'items_sizes.item_id')
                        ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                        ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                      
                        ->where('sub_categories.id', request('sub_CategoryID'))
                        ->select('items_sizes.id as id','items_sizes.size as size', DB::raw('count(*) as total'))
                        ->groupBy('items_sizes.size')
                        ->distinct()->get();
         $result['items']=$items;
         $result['all_size']=$all_sizes;
         $result['all_colors']=$all_colors;
             return response()->json(['msg' => 'success', 'status' => true, 'result' => $result], 200);
     
 }
 public function getBrandItems($lang='ar'){
         $user_id= request('UserID');
     $ofset=(request('ofset')) ? request('ofset'):0;
     $limit=40;
     $ofset=$ofset*$limit;
  $wishlists=array();
    if(!empty($user_id)){
        $wishlists1= Wishlist::where('user_id',$user_id)->select('items_id')->get();
             $i = 0;
            foreach ($wishlists1 as $row) {
                $wishlists[$i] = $row->items_id;
                $i++;
            }
         $wishlists = ($wishlists) ? $wishlists : array();
   }
   $items_query=Items::where('items.active',1);
           if(request('BrandID')){
               $items_query->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')->
                       join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                      ->join('brands', 'brands.id', '=', 'items.brands_id')
                       ->where('brands.id',request('BrandID'));
             }
             
                 if (request('sub_CategoryID')) {
                     $sub_cat= explode(',', request('sub_CategoryID'));
                    $sub_categories_id=array();
                     for($i=0;$i < count($sub_cat);$i++){
                         $sub_categories_id[$i]= intval($sub_cat[$i]);
                     }
              if(count($sub_categories_id)){
                  
               $items_query->whereIn('items.sub_categories_id',$sub_categories_id);
           }
                 }
                      if (request('CategoryID')) {
                     $cat= explode(',', request('CategoryID'));
                    $categories_id=array();
                     for($i=0;$i < count($cat);$i++){
                         $categories_id[$i]= intval($cat[$i]);
                     }
              if(count($categories_id)){
                  
               $items_query->whereIn('categories.id',$categories_id);
           }
                 }
           
             if(request('Low_Price')>=0 && request('High_Price') > 0 ){
           $items_query->whereBetween('items.discount_price', [request('Low_Price'), request('High_Price')]);
             }
               if(request('Kye_Word') ){
               $items_query->where('items.title', 'like', '%' . request('Kye_Word') . '%');

             }
             $colors1=request('colors');//is_array
          

        // $colors=[74,84];
                 if ($colors1 ) {
                     $colors= explode(',', $colors1);
                    $colors1=array();
                     for($i=0;$i < count($colors);$i++){
                         $colors1[$i]= intval($colors[$i]);
                     }
            
                  if(count($colors1)>0){
            $items_query->join('items_colors', 'items.id', '=', 'items_colors.item_id')
                       ->join('colors', 'items_colors.color_id', '=', 'colors.id')
                    ->whereIn('colors.id',$colors1);
                  }
        }
         $sizes12=request('sizes');
          if ($sizes12 ) {
                     $sizes= explode(',', $sizes12);
                    $sizes12=array();
                     for($i=0;$i < count($sizes);$i++){
                         $sizes12[$i]= intval($sizes[$i]);
                     }
                    
                  if(count($sizes12)>0){
            $items_query->join('items_sizes', 'items.id', '=', 'items_sizes.item_id')
            ->where(function($query) use ($sizes12){
             
        return $query->where('items_sizes.size', $sizes12[0]);
                for($i=1;$i<count($sizes12);$i++){
            $query->orWhere('items_sizes.size', $sizes12[$i]);
                }
                    });

                     }
          }

               $items = $items_query->select('items.id','items.title','items.thumbnail_image as image','items.discount_price as price')
                       ->skip($ofset)->take($limit)->get();
     
      foreach ($items as $row){
              if (in_array($row->id , $wishlists)) {
              $row->is_favorite = 1;
            } else {
                $row->is_favorite= 0;
            }
            
        }
        
        
        //colot cat
             $all_colors = DB::table('items_colors')
                        ->join('colors', 'colors.id', '=', 'items_colors.color_id')
                        ->join('items', 'items.id', '=', 'items_colors.item_id')
                        ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                        ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                        ->join('brands', 'brands.id', '=', 'items.brands_id')
                        ->where('colors.active', '1')
                        ->where('brands.id', request('BrandID'))
                        ->select('colors.' . $lang . '_name as title', 'colors.id as id', DB::raw('count(*) as total'))
                        ->groupBy('colors.id')
                        ->distinct()->get();
                $all_sizes = DB::table('items_sizes')
                       
                        ->join('items', 'items.id', '=', 'items_sizes.item_id')
                        ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                        ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                       ->join('brands', 'brands.id', '=', 'items.brands_id')
                        ->where('brands.id', request('BrandID'))
                        ->select('items_sizes.id as id','items_sizes.size as size', DB::raw('count(*) as total'))
                        ->groupBy('items_sizes.size')
                        ->distinct()->get();
                
                   $all_categories = DB::table('categories')
                   
                        ->join('sub_categories', 'categories.id', '=', 'sub_categories.categories_id')
                        ->join('items', 'sub_categories.id', '=', 'items.sub_categories_id')
                       ->join('brands', 'brands.id', '=', 'items.brands_id')
                        ->where('brands.id', request('BrandID'))
                        ->select('categories.id as id','categories.'.$lang.'_title as category', DB::raw('count(*) as total'))
                        ->groupBy('categories.id')
                        ->distinct()->get();
                   
                       $all_sub_categories = DB::table('sub_categories')
                   
                        ->join('items', 'sub_categories.id', '=', 'items.sub_categories_id')
                      
                       ->join('brands', 'brands.id', '=', 'items.brands_id')
                        ->where('brands.id', request('BrandID'))
                        ->select('sub_categories.id as id','sub_categories.'.$lang.'_title as category', DB::raw('count(*) as total'))
                        ->groupBy('sub_categories.id')
                        ->distinct()->get();
         $result['items']=$items;
         $result['all_size']=$all_sizes;
         $result['all_colors']=$all_colors;
          $result['categories']=$all_categories;
         $result['sub_categorie']=$all_sub_categories;
             return response()->json(['msg' => 'success', 'status' => true, 'result' => $result], 200);
 }
 public function homeList($lang='ar'){
      $user_id= request('UserID');
        
               $wishlists=array();
    if(!empty($user_id)){
        $wishlists1= Wishlist::where('user_id',$user_id)->select('items_id')->get();
             $i = 0;
            foreach ($wishlists1 as $row) {
                $wishlists[$i] = $row->items_id;
                $i++;
            }
         $wishlists = ($wishlists) ? $wishlists : array();
   }
   


     $result['latest']=Items::where('active',1)->latest()->take(9)->select('id','title','thumbnail_image as image','discount_price as price')->get();
     $result['toprates']= DB::table('items')->where('active', 1)->where('ratio', '>', 0)->
                    select('items.id','items.title','items.thumbnail_image as image','items.discount_price as price')->
                        orderByRaw("RAND()")->take(9)->get();
                       $result['onsale']=  DB::table('items')
                        ->join('reviews', 'items.id', '=', 'reviews.items_id')
                        ->where('active', 1)
                       ->select('items.id','items.title','items.thumbnail_image as image','items.discount_price as price', DB::raw('avg(reviews.rate) AS average'))
                        ->groupBy('reviews.items_id')
                        ->orderBy('average', 'desc')
                        ->orderByRaw("RAND()")
                        ->take(9)->get();
      $result['featured']=Items::where('feature',1)->where('active',1)->select('id','thumbnail_image as image')->take(2)->get();
      
        foreach ($result['latest'] as $row){
              if (in_array($row->id , $wishlists)) {
              $row->is_favorite = 1;
            } else {
                $row->is_favorite= 0;
            }
            
        }
                foreach ($result['toprates'] as $row){
              if (in_array($row->id , $wishlists)) {
              $row->is_favorite = 1;
            } else {
                $row->is_favorite= 0;
            }
            
        }
               foreach ($result['onsale'] as $row){
              if (in_array($row->id , $wishlists)) {
              $row->is_favorite = 1;
            } else {
                $row->is_favorite= 0;
            }
            
        }
       // return $result['items'];
          return response()->json(['msg' => 'success', 'status' => true, 'result' => $result], 200);
 }
 
     public function getUserFavorite($local='ar',Request $request) {
       

        $data = [
            'user_id' => 'required|numeric',
        ];



        $messages = [
            'user_id.required' => 'يجب أدخال المستخدم',
        ];

        $validator = Validator::make($request->all(), $data, $messages);
        $validator->SetAttributeNames([
            'user_id' => 'user_id',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages();


            return response()->json(['msg' => 'Error Data', 'status' => false, 'Error' => $errors], 201);
        } else {






            $items =Items::
                    join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                    ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                    ->join('brands', 'brands.id', '=', 'items.brands_id')
                    ->join('wishlists', 'wishlists.items_id', '=', 'items.id')
                    ->where('wishlists.user_id', '=', $request->user_id)
                    ->where('items.active', '=', 1)
                 ->select('items.id','items.title','items.thumbnail_image as image','items.discount_price as price','brands.'.$local.'_title as brand')
                    ->get();

     



            if ($items == null) {
                return response()->json(['message' => 'هذا المستخدم غير موجود', 'status' => False], 201);
            } else {

                return response()->json(['message' => 'المنتجات المفضلة لدى هذا المستخدم', 'status' => true, 'result' => $items], 201);
            }
        }
    }

    public function home_by_cat($lang='ar'){
       $user_id= request('UserID');
                    $wishlists=array();
    if(!empty($user_id)){
        $wishlists1= Wishlist::where('user_id',$user_id)->select('items_id')->get();
             $i = 0;
            foreach ($wishlists1 as $row) {
                $wishlists[$i] = $row->items_id;
                $i++;
            }
         $wishlists = ($wishlists) ? $wishlists : array();
   }
    $cat_id=request('CategoryID');
   $sub_cat= Sub_categories::join('items', 'sub_categories.id', '=', 'items.sub_categories_id')
               ->where('sub_categories.categories_id',$cat_id)->where('sub_categories.active', 1)->select('sub_categories.id','sub_categories.'.$lang.'_title as name')
             ->distinct()->get();
       foreach ($sub_cat as $row){
            $row->items=Items::where('items.active',1)->where('items.sub_categories_id',$row->id)->latest()->
                    take(9)->select('id','title','thumbnail_image as image','discount_price as price')->get();
                 foreach ($row->items as $row){
              if (in_array($row->id , $wishlists)) {
              $row->is_favorite = 1;
            } else {
                $row->is_favorite= 0;
            }
            
        }
       }
    
                return response()->json(['msg' => 'success', 'status' => true, 'result' => $sub_cat], 200);
     
 }
 public function homeSearch($lang='ar'){
    
         $user_id= request('UserID');
     $ofset=(request('ofset')) ? request('ofset'):0;
     $limit=40;
     $ofset=$ofset*$limit;
  $wishlists=array();
    if(!empty($user_id)){
        $wishlists1= Wishlist::where('user_id',$user_id)->select('items_id')->get();
             $i = 0;
            foreach ($wishlists1 as $row) {
                $wishlists[$i] = $row->items_id;
                $i++;
            }
         $wishlists = ($wishlists) ? $wishlists : array();
   }
   $items_query=Items::where('items.active',1);
  
               if(request('Kye_Word') ){
               $items_query->where('items.title', 'like', '%' . request('Kye_Word') . '%');

             }
    

               $items = $items_query->select('items.id','items.title','items.thumbnail_image as image','items.discount_price as price')
                       ->skip($ofset)->take($limit)->get();
      foreach ($items as $row){
              if (in_array($row->id , $wishlists)) {
              $row->is_favorite = 1;
            } else {
                $row->is_favorite= 0;
            }
            
        }
         return response()->json(['msg' => 'success', 'status' => true, 'result' => $items], 200);
     
 }
 
 public function getItemDetails($lang='ar'){
    
         $item_id= request('ItemID');
         $user_id= request('UserID');
           $wishlists=array();
    if(!empty($user_id)){
        $wishlists1= Wishlist::where('user_id',$user_id)->select('items_id')->get();
             $i = 0;
            foreach ($wishlists1 as $row) {
                $wishlists[$i] = $row->items_id;
                $i++;
            }
         $wishlists = ($wishlists) ? $wishlists : array();
   }
   if($item_id){
       $admin_data = Items::with('sub_categories:id,'.$lang.'_title as name','items_sizes','items_colors','items_images','accessories.items','item_specifications')
               
               ->select('items.id','items.desc as description','items.title','items.thumbnail_image as image','items.discount_price as price','items.ratio','items.ratio','items.sub_categories_id')->findOrFail($item_id);

         if (in_array($admin_data->id , $wishlists)) {
              $admin_data->is_favorite = 1;
            } else {
                $admin_data->is_favorite= 0;
            }
     return response()->json(['msg' => 'success', 'status' => true, 'result' => $admin_data], 200);
       
 }
 }
 
 
 public function getShoppingCart($lang='ar'){
      $user_id= request('UserID');
       $itemscart = DB::table('carts')->join('items', 'items.id', '=', 'carts.item_id')->where(['carts.user_id' => $user_id])
               
               ->select('carts.*','items.thumbnail_image as image','items.discount_price as price','items.title as name')
               ->get();
          return response()->json(['msg' => 'success', 'status' => true, 'result' => $itemscart], 200);
 }
 public function removeFromCart($lang='ar'){
     
      
     $id= request('id');
      $user_id= request('UserID');
       Cart::destroy($id);
       $itemscart = DB::table('carts')->where(['user_id' => $user_id])->get();
          return response()->json(['msg' => 'success', 'status' => true, 'result' => $itemscart], 200);
     
 }
 public function addToCart($lang='ar'){
     if(!empty(request('UserID')) && !empty(request('price') )&& !empty(request('name')) ){
         $user_id= request('UserID');
          $item_id= request('ItemID');
          $cartdata = Cart::where('user_id', $user_id)->where('item_id', $item_id)->first();
                    if ($cartdata == null) {
                        $add = new Cart();
                        $add->user_id = $user_id;
                        $add->item_id = $item_id;
                        $add->quantity = (request('quantity'))?request('quantity'):1;
                        $add->price =  request('price');
                        $add->color =  request('color');
                        $add->size =  request('size');
                        $add->image =  request('image');
                        $add->name =  request('name');
                        $add->save();
                    } else {
                        $cartdata->quantity = $cartdata->quantity + request('quantity');
                        $cartdata->save();
                    }
                         return response()->json(['message' => 'Successfully', 'status' => true], 200);
     }
             return response()->json(['message' => 'required data', 'status' => FALSE], 200);

 }
 
}
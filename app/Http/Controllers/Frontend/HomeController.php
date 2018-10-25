<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Items;
use App\Item_view;
use App\Wishlist;
use App\Http\Requests;
use Validator;
use Auth;
use DB;
use App;
use Hash;
use Mail;
use App\Categories;
use \Cart as Cart;
class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //  $this->middleware('auth');
        $url_segment = \Request::segment(1);
        if ($url_segment == 'ar' || $url_segment == 'en') {
            App::setLocale($url_segment);
            $locale = App::getLocale();
        } else {
            App::setLocale('ar');
            $locale = App::getLocale();
        }

        session(['sess_locale' => $locale]);
        $sess_locale = session('sess_locale');
    }

    /**
     * Show the application dashboard.
     *   Cart::add('192ao12', 'Product 1', 1, 9.99);
         $contents=Cart::content();
         return $contents;
           die;
     * @return \Illuminate\Http\Response
     */
    public function index($locale = "", Request $request) {
        

        $per_page = 15;
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }

        $locale_name = $locale . '_name';
        $locale_title = $locale . '_title';

        if (auth()->user()) {
            $addmemberid = auth()->user()->id;
        } else {
            $addmemberid = 0;
        }

        $all_cities = DB::table('cities')
                ->join('countries', 'countries.id', '=', 'cities.country_id')
                ->where('countries.active', '=', '1')
                ->select('countries.' . $locale . '_name as name1', 'cities.' . $locale . '_name as name2', 'cities.id as cities_id')
                ->get();


        $all_latest = Items::with('items_colors.colors','items_sizes')
                            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                            ->where('items.active', '=', 1)
                          ->latest()
                      //  ->select('title', 'id', 'thumbnail_image', 'fixed_price', 'ratio', 'discount_price')
                        ->select('items.*', 'categories.' . $locale . '_title as CategoryName', 'sub_categories.' . $locale . '_title as SubCategoryName')
                       // ->orderByRaw("RAND()")
                        ->take(1)
                        ->get();

 $all_latest2 = Items::with('items_colors.colors','items_sizes')
                            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                            ->where('items.active', '=', 1)
                            
                      //  ->select('title', 'id', 'thumbnail_image', 'fixed_price', 'ratio', 'discount_price')
                        ->select('items.*', 'categories.' . $locale . '_title as CategoryName', 'sub_categories.' . $locale . '_title as SubCategoryName')
                       
                       ->orderBy('items.created_at','=','desc')
                       ->skip(1)
                        ->take(2)
                        ->get();

$all_latest3 = Items::with('items_colors.colors','items_sizes')
                            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                            ->where('items.active', '=', 1)
                            
                      //  ->select('title', 'id', 'thumbnail_image', 'fixed_price', 'ratio', 'discount_price')
                        ->select('items.*', 'categories.' . $locale . '_title as CategoryName', 'sub_categories.' . $locale . '_title as SubCategoryName')
                       
                       ->orderBy('items.created_at','=','desc')
                       ->skip(3)
                        ->take(2)
                        ->get();



$all_feature2 = Items::with('items_colors.colors','items_sizes')
                            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                            ->where('items.active', '=', 1)
                            ->where('items.feature', '=', 1)
                            
                      //  ->select('title', 'id', 'thumbnail_image', 'fixed_price', 'ratio', 'discount_price')
                        ->select('items.*', 'categories.' . $locale . '_title as CategoryName', 'sub_categories.' . $locale . '_title as SubCategoryName')
                        ->orderByRaw("RAND()")
                        ->take(2)
                        ->get();

$all_feature1 = Items::with('items_colors.colors','items_sizes')
                            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                            ->where('items.active', '=', 1)
                            ->where('items.feature', '=', 1)
                            
                      //  ->select('title', 'id', 'thumbnail_image', 'fixed_price', 'ratio', 'discount_price')
                        ->select('items.*', 'categories.' . $locale . '_title as CategoryName', 'sub_categories.' . $locale . '_title as SubCategoryName')
                        ->orderByRaw("RAND()")
                        ->take(2)
                        ->get();

        $lang = App::getLocale();
        $items_query_cat_one = DB::table('categories')
                        ->where('categories.home_position', '=', "1")
                        ->select('categories.*')
                        ->distinct()->first();

        $items_query = array();
        if (!empty($items_query_cat_one)) {
            $items_query = Items::with('items_colors.colors','items_sizes')
                            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                            ->where('items.active', '1')
                            ->where('categories.id', $items_query_cat_one->id)
                            ->select('items.*', 'categories.' . $lang . '_title as CategoryName', 'sub_categories.' . $lang . '_title as SubCategoryName')
                            ->limit(18)
                            ->get();
        }
        // return $items_query;


        $items_query_cat_two = DB::table('categories')
                        ->where('categories.home_position', '=', "2")
                        ->select('categories.*')
                        ->distinct()->first();
        
  
        if (!empty($items_query_cat_two)) {
            $items_query_two = Items::with('items_colors.colors','items_sizes')
                            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                            ->where('items.active', '1')
                            ->where('categories.id', $items_query_cat_two->id)
                            ->select('items.*', 'categories.' . $lang . '_title as CategoryName', 'sub_categories.' . $lang . '_title as SubCategoryName')
                            ->limit(18)
                            ->get();
        }

     // return $items_query_two;
        $items_query_cat_three = DB::table('categories')
                        ->where('categories.home_position', '=', "3")
                        ->select('categories.*')
                        ->distinct()->first();
        $items_query_three = array();
        if (!empty($items_query_cat_three)) {
            $items_query_three = Items::with('items_colors.colors','items_sizes')
                            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                            ->where('items.active', '1')
                            ->where('categories.id', $items_query_cat_three->id)
                            ->select('items.*', 'categories.' . $lang . '_title as CategoryName', 'sub_categories.' . $lang . '_title as SubCategoryName')
                            ->limit(18)
                            ->get();
        }
        $items_query_cat_four = DB::table('categories')
                        ->where('categories.home_position', '=', "4")
                        ->select('categories.*')
                        ->distinct()->first();
        $items_query_four = array();
        if (!empty($items_query_cat_four)) {
            $items_query_four = Items::with('items_colors.colors','items_sizes')
                            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                            ->where('items.active', '1')
                            ->where('categories.id', $items_query_cat_four->id)
                            ->select('items.*', 'categories.' . $lang . '_title as CategoryName', 'sub_categories.' . $lang . '_title as SubCategoryName')
                            ->limit(6)
                            ->get();
        }
        $items_query_cat_five = DB::table('categories')
                        ->where('categories.home_position', '=', "5")
                        ->select('categories.*')
                        ->distinct()->first();
        $items_query_five = array();
        if (!empty($items_query_cat_five)) {
            $items_query_five = Items::join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                            ->where('items.active', '1')
                            ->where('categories.id', $items_query_cat_five->id)
                            ->select('items.*', 'categories.' . $lang . '_title as CategoryName', 'sub_categories.' . $lang . '_title as SubCategoryName')
                            ->limit(7)
                            ->get();
        }
   
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'items_query' => $items_query,
            'items_query_two' => (@$items_query_two)?$items_query_two:[],
            'items_query_three' => $items_query_three,
            'items_query_four' => $items_query_four,
            'items_query_five' => (@$items_query_five) ? $items_query_five: [],
            'body_class' => 'page home page-template-default',
            'locale_name' => $locale_name,
            'all_latest' =>$all_latest,
             'all_latest2' =>$all_latest2,
             'all_latest3' =>$all_latest3,
             'all_feature2' =>$all_feature2,
             'all_feature1' =>$all_feature1,
             

            'locale_title' => $locale_title,
        ];

        return view(FE . '.home')->with($data);
    }

    public function get_data() {
        // $data['start'] = Items::orderBy('start_date', 'DESC')->where('items.active', '=', "1")->take(5)->get();
        // $data['end'] = Items::orderBy('end_date', 'asc')->where('items.active', '=', "1")->take(5)->get();
        //  return $data;
    }

}

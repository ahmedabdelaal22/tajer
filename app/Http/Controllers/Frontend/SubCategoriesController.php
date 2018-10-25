<?php

namespace App\Http\Controllers\Frontend;

use App\Sub_categories;
use App\Categories;
use App\Brands;
use Illuminate\Http\Request;
///
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Items;
use Auth;
use App\User;
use App;
use DB;
use Response;
use File;
use Session;

class SubCategoriesController extends Controller {

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

    // public function Allcategories($locale) {

    //     $lang = App::getLocale();
    //             if ($locale == "") {
    //         $locale = session('sess_locale');
    //     } else {
    //         App::setLocale($locale);
    //         $locale = App::getLocale();
    //     }

    //     $locale_name = $locale . '_name';
    //     $locale_title = $locale . '_title';
    //     $categories = Categories::where('active', 1)->get();


    //     $data = [
    //         'title' => trans('cpanel.site_name'),

    //         'categories' => $categories,
    //         'lang' => $lang,

    //         'locale_title'=>$locale_title,

    //     ];

    //     return view(FE . '.all_categories')->with($data);
    // }




    public function Allcategories($locale = "", Request $request) {
//        return $request->all();
        $per_page = 16;
        $lang = App::getLocale();
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }

        $locale_name = $locale . '_name';
        $locale_title = $locale . '_title';

        $categories = Categories::where('active', 1)->paginate($per_page);


        $data = [
            'title' =>trans('cpanel.site_name'),
            'locale' => $locale,

            'locale_title'=>$locale_title,

            'categories' => $categories,
        ];


        if ($request->ajax()) {

            $view = view(FE . '.all_categories_load_more', compact('data'))->render();
            // return $view;
            return response()->json(['html' => $view]);
        }
        return view(FE . '.all_categories', compact(array('categories','locale_title','locale')));
//        return view(FE . '.get_wishlist')->with($data);
    }






    public function categories(Request $request, $locale = "", $cat_id) {
        $lang = App::getLocale();
        $per_page = 30;
        session(['type' => 2]);
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }

        if (auth()->user()) {
            $addmemberid = auth()->user()->id;
        } else {
            $addmemberid = 0;
        }

        $items_colors = Sub_categories::join("items","sub_categories.id","=","items.sub_categories_id")
            ->where('sub_categories.active', 1)->where('sub_categories.categories_id', $cat_id)
            ->join("items_colors","items.id","=","items_colors.item_id")
            ->join("colors","items_colors.color_id","=","colors.id")
            ->select("colors.id","colors.". $locale ."_name as name")
            ->distinct()
            ->get();


        $items_sizes = Sub_categories::join("items","sub_categories.id","=","items.sub_categories_id")
            ->where('sub_categories.active', 1)->where('sub_categories.categories_id', $cat_id)
            ->join("items_sizes","items.id","=","items_sizes.item_id")
            ->select("items_sizes.id","items_sizes.size")
            ->distinct()
            ->get();

        $sub_cat = Sub_categories::where('active', 1)->where('categories_id', $cat_id)->get();
        $brands = Brands::where('active', 1)->get();

        // $latest_product = Items::orderBy('created_at', 'DESC')
        // ->where('items.active', '=', "1")
        // ->take(10)
        // ->get();
        $latest_product_data = Items::orderBy('items.created_at', 'DESC')
            ->where('items.active', '=', "1")
            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
            ->where('categories.id', $cat_id)
            ->take(10)
            ->get();

        $all_sub_cat = Sub_categories::where('active', 1)
            ->where('categories_id', $cat_id)
            ->select('sub_categories.' . $locale . '_title as title', 'sub_categories.id as id')
            ->get();

        $all_Categories = Categories::where('active', 1)
            ->where('id', '=', $cat_id)
            ->select($locale . '_title as title', 'id as id')
            ->first();

        if(!$all_Categories){
            return view('errors.404');
        }

        $all_cities = DB::table('cities')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->where('countries.active', '=', '1')
            ->select('countries.' . $locale . '_name as name1', 'cities.' . $locale . '_name as name2', 'cities.id as cities_id')
            ->get();


        $all_countries = DB::table('countries')
            ->join('cities', 'cities.country_id', '=', 'countries.id')
            ->join('items', 'cities.id', '=', 'items.cities_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
            ->where('countries.active', '1')
            ->where('cities.country_id', '11')
            ->where('categories.id', $cat_id)
            ->select('cities.' . $locale . '_name as name', 'cities.id as id')
            ->distinct()->get();

        $all_brands = DB::table('brands')
            ->join('items', 'brands.id', '=', 'items.brands_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
            ->where('brands.active', '1')
            ->where('categories.id', $cat_id)
            ->select('brands.' . $locale . '_title as title', 'brands.id as id')
            ->distinct()->get();

        $all_status = DB::table('status')
            ->join('items', 'status.id', '=', 'items.status_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
            ->where('status.active', '1')
            ->where('categories.id', $cat_id)
            ->select('status.' . $locale . '_title as title', 'status.id as id')
            ->distinct()->get();
//            $maxprice=Items::where('active', 1)->where('sub_categories_id', $sub_cat_id)->max('fixed_price');

        $items_query = Items::with('user', 'cities.country', 'sub_categories.categories')
            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')

            ->where('items.active', 1)->where('categories.id', $cat_id);



        $items_query->select('items.*', 'items.user_id as user_wishlist');
        $items = $items_query->paginate($per_page);




        if (count($items) == 0) {

            $all_sub_cat = Sub_categories::where('active', 1)
                ->select('sub_categories.' . $locale . '_title as title', 'sub_categories.id as id')
                ->get();

            $all_cities = DB::table('cities')
                ->join('countries', 'countries.id', '=', 'cities.country_id')
                ->where('countries.active', '=', '1')
                ->select('countries.' . $locale . '_name as name1', 'cities.' . $locale . '_name as name2', 'cities.id as cities_id')
                ->get();


            $all_countries = DB::table('cities')
                //->where('cities.active', '1')
                ->select('cities.' . $locale . '_name as name', 'cities.id as id')
                ->get();

            $all_brands = DB::table('brands')
                ->where('brands.active', '1')
                ->select('brands.' . $locale . '_title as title', 'brands.id as id')
                ->get();

            $all_status = DB::table('status')
                ->where('status.active', '1')
                ->select('status.' . $locale . '_title as title', 'status.id as id')
                ->get();


            $latest_product_data = Items::orderBy('items.created_at', 'DESC')
                ->where('items.active', '=', "1")
                ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                ->where('categories.id', $cat_id)
                ->take(10)
                ->get();


        }


        foreach ($items as $value) {
            $fav_items_query = DB::table('wishlists')
                ->where('wishlists.items_id', '=', $value->id)
                ->where('wishlists.user_id', '=', $addmemberid)
                ->select('wishlists.*')
                ->paginate($per_page);

            if (count($fav_items_query) > 0) {
                $fav_items = 1;
            } else {
                $fav_items = 0;
            }
            $value->user_wishlist = $fav_items;
        }


        // $end = Items::where('items.active', 1)->orderBy('end_date', 'asc')->paginate(16);
        $latest_product = Items::orderBy('created_at', 'DESC')->where('items.active', '=', "1")->take(5)->get();

        $body_class = 'left-sidebar';
        $locale_name = $locale . '_name';
        $locale_title = $locale . '_title';
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'items' => $items,
            'all_status' => $all_status,
            'latest_product_data' => $latest_product_data,
            'body_class' => 'left-sidebar',
            'items_colors' => $items_colors,
            'items_sizes' => $items_sizes,
            'all_countries' => $all_countries,
            'latest_product' => $latest_product,
            'all_sub_cat' => $all_sub_cat,
            'all_brands' =>$all_brands,
            'all_Categories' => $all_Categories,
            'lang' => $lang,
            'sub_cat' => $sub_cat,
            'brands' =>$brands,
            'locale_title'=>$locale_title,
            'cat_id' => $cat_id,
            'locale_name' => $locale_name,

        ];

//        return $data;
        if ($request->ajax()) {
            $view = view(FE . '.items_by_subcategory_load_more', compact('data'))->render();

//            $view = view(FE . '.items_by_subcategory_load_more', compact('data'))->render();

            return response()->json(['html' => $view]);
        }

        // return view(FE . '.categories', compact(array('data', 'body_class')));
        return view(FE . '.categories', compact(array('data', 'body_class', 'sub_cat','lang','brands','locale_title','items','title','all_sub_cat','all_brands','latest_product_data',"items_colors","items_sizes")));
    }

    public function sub_category($locale = "", $sub_cat_id) {



        $category = Sub_categories::with('categories')->findOrFail($sub_cat_id);
        $filter_price = $this->max_min_price($sub_cat_id);
        $maxprice = $filter_price['maxprice'];
        $minprice = $filter_price['minprice'];

        $items_query = Items::with('items_colors.colors')->where('active', 1)->where('sub_categories_id', $sub_cat_id);

        if (request('filteration2') != 'not' && request('filteration2')) {
            if (request('filteration2') == 'rating') {
                $items_query->leftJoin('reviews', 'items.id', '=', 'reviews.items_id')->select('items.*', DB::raw('avg(COALESCE(reviews.rate, 0)) AS average'))
                    ->groupBy('items.id')
                    ->orderBy('average', 'desc');
            } else {
                $filteration = explode(',', request('filteration2'));
                $items_query->orderBy($filteration[0], $filteration[1]);

            }
        }
        $items = $items_query->paginate(3);
//return $items;
        $latest_product = Items::orderBy('created_at', 'DESC')->where('items.active', '=', "1")->take(5)->get();
        $lang = App::getLocale();
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'body_class' => 'left-sidebar',
            'items' => $items,
            'lang' => $lang,
            'sub_cat_id' => $sub_cat_id,
            'category' => $category,
            'minprice' => $minprice,
            'maxprice' => $maxprice,
            'latest_product'=>$latest_product,
            'header'=>'Frontend/include/header'
        ];


        if (request()->ajax()) {


            $view = view(FE . '.items_by_subcategory_load_more')->with($data)->render();

            return response()->json(['html' => $view]);
        }

        return view(FE . '.sub_category')->with($data);
    }



    public function filter_category(Request $request, $locale = "") {


// print_r($sub_cat); return;
        if ($request->has('cat_id')) {

            session(['requestcat' => $request->all()]);
            $cat_id = $request->cat_id;
            $sub_cat = @$request->sub_cat;
            $colors = @$request->colors;
            $sizes = @$request->sizes;

            $brand = @$request->brands;
            $status = @$request->status;
            $countries = $request->countries;
            $from_price = $request->from_price;
            $to_price = $request->to_price;
            $amount = $request->amount;
        } else {
            $request1 = session('requestcat');

            $cat_id = $request1['cat_id'];
            $brand = @$request1['brands'];
            $sub_cat = @$request1['sub_cat'];
            $colors = @$request1['colors'];
            $sizes = @$request1['sizes'];
            $status = @$request1['status'];
            $countries = @$request1['countries'];
            $from_price = @$request1['from_price'];
            $to_price = @$request1['to_price'];
            $amount = @$request1['amount'];
        }

        $lang = App::getLocale();

//echo $request->amount.'/'. $strmax.'/'.$strmin;die;

        $per_page = 30;
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }

        if (auth()->user()) {
            $addmemberid = auth()->user()->id;
        } else {
            $addmemberid = 0;
        }

        $items_colors = Sub_categories::join("items","sub_categories.id","=","items.sub_categories_id")
            ->where('sub_categories.active', 1)->where('sub_categories.categories_id', $cat_id)
            ->join("items_colors","items.id","=","items_colors.item_id")
            ->join("colors","items_colors.color_id","=","colors.id")
            ->select("colors.id","colors.". $locale ."_name as name")
            ->distinct()
            ->get();


        $items_sizes = Sub_categories::join("items","sub_categories.id","=","items.sub_categories_id")
            ->where('sub_categories.active', 1)->where('sub_categories.categories_id', $cat_id)
            ->join("items_sizes","items.id","=","items_sizes.item_id")
            ->select("items_sizes.id","items_sizes.size")
            ->distinct()
            ->get();

        $sub_cat2 = Sub_categories::where('active', 1)->where('categories_id', $cat_id)->get();
        $brands = Brands::where('active', 1)->get();


        $all_sub_cat = Sub_categories::where('active', 1)->where('categories_id', $cat_id)
            ->select('sub_categories.' . $locale . '_title as title', 'sub_categories.id as id')
            ->get();

        $all_Categories = Categories::where('active', 1)
            ->where('id', '=', $cat_id)
            ->select($locale . '_title as title', 'id as id')
            ->first();

        $all_cities = DB::table('cities')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->where('countries.active', '=', '1')
            ->select('countries.' . $locale . '_name as name1', 'cities.' . $locale . '_name as name2', 'cities.id as cities_id')
            ->get();


        $all_countries = DB::table('countries')
            ->join('cities', 'cities.country_id', '=', 'countries.id')
            ->join('items', 'cities.id', '=', 'items.cities_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
            ->where('countries.active', '1')
            ->where('categories.id', $cat_id)
            ->select('cities.' . $locale . '_name as name', 'cities.id as id')
            ->distinct()->get();

        $all_brands = DB::table('brands')
            ->join('items', 'brands.id', '=', 'items.brands_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
            ->where('brands.active', '1')
            ->where('categories.id', $cat_id)
            ->select('brands.' . $locale . '_title as title', 'brands.id as id')
            ->distinct()->get();

        $all_status = DB::table('status')
            ->join('items', 'status.id', '=', 'items.status_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
            ->where('status.active', '1')
            ->where('categories.id', $cat_id)
            ->select('status.' . $locale . '_title as title', 'status.id as id')
            ->distinct()->get();

        $latest_product_data = Items::orderBy('items.created_at', 'DESC')
            ->where('items.active', '=', "1")
            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
            ->where('categories.id', $cat_id)
            ->take(10)
            ->get();


        $items_query = Items::with('user', 'cities.country', 'sub_categories.categories')
            ->join('cities', 'items.cities_id', '=', 'cities.id')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
            ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
            ->leftJoin("items_colors","items.id","=","items_colors.item_id")
            ->leftJoin("colors","items_colors.color_id","=","colors.id")
            ->leftJoin("items_sizes","items.id","=", "items_sizes.item_id")
            ->where('items.active', 1)->where('categories.id', $cat_id);
        if (count($brand) > 0) {
            // print_r($brand); return;
            $items_query->whereIn('items.brands_id', $brand);
        }

        //sub_cat
        if (count($sub_cat) > 0) {
            //  print_r($sub_cat); return;

            $items_query->whereIn('items.sub_categories_id', $sub_cat);
        }

        if (count($colors) > 0) {

            $items_query->whereIn('colors.id', $colors);
        }

        if (count($sizes) > 0) {
//            $items_query = $items_query->join("items_sizes","items.id","=", "items_sizes.item_id");
            $items_query->whereIn('items_sizes.id', $sizes);
        }



        // if ($from_price) {

        //     $items_query->whereBetween('items.discount_price', [$from_price,$to_price]);
        // }

        if ($from_price) {

            $items_query->where('items.discount_price','>',$from_price);
        }

        if ($to_price) {

            $items_query->where('items.discount_price','<', $to_price);
        }

        $items_query->select('items.*', 'items.user_id as user_wishlist')->distinct();

        $items = $items_query->paginate($per_page);
        //       echo "<pre>";
        //               print_r($items);
        // echo "</pre>";
        //               return;

        foreach ($items as $value) {
            $fav_items_query = DB::table('wishlists')
                ->where('wishlists.items_id', '=', $value->id)
                ->where('wishlists.user_id', '=', $addmemberid)
                ->select('wishlists.*')
                ->paginate($per_page);

            if (count($fav_items_query) > 0) {
                $fav_items = 1;
            } else {
                $fav_items = 0;
            }
            $value->user_wishlist = $fav_items;
        }


        if (count($brand) == 0) {
            $brand = array();
        }
        if (count($countries) == 0) {
            $countries = array();
        }
        if (count($status) == 0) {
            $status = array();
        }
        if (count($sub_cat) == 0) {
            $sub_cat = array();
        }
        if (count($colors) == 0) {
            $colors = array();
        }
        if (count($sizes) == 0) {
            $sizes = array() ;
        }

        $locale_name = $locale . '_name';
        $locale_title = $locale . '_title';
        $latest_product = Items::orderBy('created_at', 'DESC')->where('items.active', '=', "1")->take(5)->get();
        $body_class = 'left-sidebar';
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'body_class' => 'page home page-template-default',
            'items' => $items,
            'from_price' => $from_price,
            'to_price' => $to_price,
            'latest_product_data' => $latest_product_data,
            'body_class' => 'left-sidebar',
            "items_colors" => $items_colors,
            "colors" => $colors,
            "sizes" => $sizes,
            "items_sizes" => $items_sizes,
            'all_brands' => $all_brands,
            'all_countries' => $all_countries,
            'all_status' => $all_status,
            'all_sub_cat' => $all_sub_cat,
            'cat_id' => $cat_id,
            'brand' => $brand,
            'status' => $status,
            'sub_cat' => $sub_cat,
            'sub_cat2' => $sub_cat2,
            'countries' => $countries,
            'locale_name' => $locale_name,
            'locale_title' => $locale_title,
            'all_Categories' => $all_Categories,
            'all_sub_cat_row' => '',
        ];


        if ($request->ajax()) {
            $view = view(FE . '.items_by_subcategory_load_more', compact('data'))->render();

            return response()->json(['html' => $view]);
        }
        // $minprice = $strmin;

        // $maxprice = $strmax;

        return view(FE . '.filter_cat', compact(array('data', 'body_class', 'sub_cat', 'sub_cat2','lang','brands','brand','locale_title','items','title','all_sub_cat','all_brands','latest_product_data','from_price','to_price',"items_colors","items_sizes","colors","sizes")));
    }


    public function filter(){

        $sub_cat_id= request('sub_cat_id');

        if (!empty(request('amount'))) {
            $prices = explode('-', request('amount'));

            $maxprice = trim(strip_tags($prices[1]));
            $minprice = trim(strip_tags($prices[0]));
        }else{
            $filter_price = $this->max_min_price($sub_cat_id);
            $maxprice = $filter_price['maxprice'];
            $minprice = $filter_price['minprice'];
        }
        $brand=request('brands');
        $coloers=request('colors');


        $category = Sub_categories::with('categories')->findOrFail($sub_cat_id);




        $items_query = Items::where('items.active', 1)->where('items.sub_categories_id', $sub_cat_id);

        if (request('filteration2') != 'not' && request('filteration2')) {
            if (request('filteration2') == 'rating') {
                $items_query->leftJoin('reviews', 'items.id', '=', 'reviews.items_id')->select('items.*', DB::raw('avg(COALESCE(reviews.rate, 0)) AS average'))
                    ->groupBy('items.id')
                    ->orderBy('average', 'desc');
            } else {
                $filteration = explode(',', request('filteration2'));
                $items_query->orderBy($filteration[0], $filteration[1]);

            }
        }
        if (count($brand) > 0 && !empty(@$brand[0])) {
            $items_query->whereIn('items.brands_id', $brand);
        }
        if (count($coloers) > 0 && !empty(@$coloers[0])) {
            $items_query->join('items_colors', 'items.id', '=', 'items_colors.item_id')
                ->join('colors', 'colors.id', '=', 'items_colors.color_id')
                ->whereIn('colors.id', $coloers);
        }
        $items = $items_query->paginate(3);
        $latest_product = Items::orderBy('created_at', 'DESC')->where('items.active', '=', "1")->take(5)->get();
        $lang = App::getLocale();
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'body_class' => 'left-sidebar',
            'items' => $items,
            'lang' => $lang,
            'sub_cat_id' => $sub_cat_id,
            'brand' => is_array(request('brands')) ? request('brands'): [request('brands')],
            'coloers' => is_array(request('colors')) ? request('colors'): [request('colors')],
            'category' => $category,
            'minprice' => $minprice,
            'maxprice' => $maxprice,
            'latest_product'=>$latest_product
        ];


        if (request()->ajax()) {


            $view = view(FE . '.items_by_subcategory_load_more')->with($data)->render();

            return response()->json(['html' => $view]);
        }


        return view(FE . '.filter')->with($data);

    }

    public function max_min_price($sub_cat_id) {
        $data['maxprice'] = Items::where('active', 1)->where('sub_categories_id', $sub_cat_id)->max('discount_price');

        $data['minprice'] = Items::where('active', 1)->where('sub_categories_id', $sub_cat_id)->min('discount_price');


        return $data;
    }

    // public function search($locale = '', Request $request) {

    //      $per_page = 15;
    //      if ($locale == "") {
    //          $locale = session('sess_locale');
    //      } else {
    //          App::setLocale($locale);
    //          $locale = App::getLocale();
    //      }

    //      $locale_name = $locale . '_name';
    //      $locale_title = $locale . '_title';

    //      if ($request->has('category_id')) {
    //          session(['requestsear1' => $request->all()]);
    //          $category_id = $request->input('category_id');

    //          $search = $request->input('search');
    //      } else {
    //          $requestsrt = session('requestsear1');

    //          $category_id = @$requestsear['category_id'];

    //          $search = @$requestsear['search'];
    //      }



    //      $items_query = Items::with('user', 'cities.country', 'sub_categories.categories')
    //              ->leftJoin('sub_categories', 'items.sub_categories_id', '=', 'sub_categories.id')
    //              ->leftJoin('categories', 'sub_categories.categories_id', '=', 'categories.id')
    //              ->where('items.active', '=', "1");



    //      if (!empty($category_id)) {
    //          $items_query->where('categories.id', $category_id);
    //      }

    //      if (!empty($search)) {

    //          $items_query->where('items.title', 'like', '%' . $search . '%');
    //      }





    //      $items_query->select('items.*');

    //      $items = $items_query->paginate($per_page);


    //     // return $items;
    //            $lang = App::getLocale();
    //      $data = [
    //          'title' => trans('cpanel.site_name'),
    //          'page_title' => trans('cpanel.login'),
    //          'submit_button' => trans('cpanel.login'),
    //          'items' => $items,

    //        'body_class' => 'left-sidebar',
    //          'lang' => $lang,
    //      ];
    //         if (request()->ajax()) {


    //          $view = view(FE . '.items_by_subcategory_load_more')->with($data)->render();

    //          return response()->json(['html' => $view]);
    //      }


    //     return view(FE . '.search')->with($data);
    //  }

    public function search($locale = '', Request $request) {
        $lang = App::getLocale();

        $per_page = 30;
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }

        $locale_name = $locale . '_name';
        $locale_title = $locale . '_title';

        $all_sub_cat = Sub_categories::where('active', 1)
            ->select('sub_categories.' . $locale . '_title as title', 'sub_categories.id as id')
            ->get();


        if ($request->has('category_id')) {
            session(['requestsear1' => $request->all()]);
            $category_id = $request->input('category_id');

            $search = $request->input('search');

            $all_sub_cat = Sub_categories::where('active', 1)
                ->where('categories_id', $category_id)
                ->select('sub_categories.' . $locale . '_title as title', 'sub_categories.id as id')
                ->get();

            $all_brands = DB::table('brands')
                ->join('items', 'brands.id', '=', 'items.brands_id')
                ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                ->where('brands.active', '1')
                ->where('categories.id', $category_id)
                ->select('brands.' . $locale . '_title as title', 'brands.id as id')
                ->distinct()->get();

            $latest_product_data = Items::orderBy('items.created_at', 'DESC')
                ->where('items.active', '=', "1")
                ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                ->where('categories.id', $category_id)
                ->take(10)
                ->get();

        } else {
            $requestsrt = session('requestsear1');


            $category_id = @$requestsear['category_id'];

            $search = @$requestsear['search'];

            $all_sub_cat = Sub_categories::where('active', 1)
                ->where('categories_id', $category_id)
                ->select('sub_categories.' . $locale . '_title as title', 'sub_categories.id as id')
                ->get();

            $all_brands = DB::table('brands')
                ->join('items', 'brands.id', '=', 'items.brands_id')
                ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                ->where('brands.active', '1')
                ->where('categories.id', $category_id)
                ->select('brands.' . $locale . '_title as title', 'brands.id as id')
                ->distinct()->get();

            $latest_product_data = Items::orderBy('items.created_at', 'DESC')
                ->where('items.active', '=', "1")
                ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
                ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
                ->where('categories.id', $category_id)
                ->take(10)
                ->get();

        }


        if (auth()->user()) {
            $addmemberid = auth()->user()->id;
        } else {
            $addmemberid = 0;
        }

        $items_colors = Sub_categories::join("items","sub_categories.id","=","items.sub_categories_id")
            ->where('sub_categories.active', 1)->where('sub_categories.categories_id', $category_id)
            ->join("items_colors","items.id","=","items_colors.item_id")
            ->join("colors","items_colors.color_id","=","colors.id")
            ->select("colors.id","colors.". $locale ."_name as name")
            ->distinct()
            ->get();


        $items_sizes = Sub_categories::join("items","sub_categories.id","=","items.sub_categories_id")
            ->where('sub_categories.active', 1)->where('sub_categories.categories_id', $category_id)
            ->join("items_sizes","items.id","=","items_sizes.item_id")
            ->select("items_sizes.id","items_sizes.size")
            ->distinct()
            ->get();

        $all_cities = DB::table('cities')
            ->join('countries', 'countries.id', '=', 'cities.country_id')
            ->where('countries.active', '=', '1')
            ->select('countries.' . $locale . '_name as name1', 'cities.' . $locale . '_name as name2', 'cities.id as cities_id')
            ->get();

        $items_query = Items::with('user', 'cities.country', 'sub_categories.categories')
            ->leftJoin('sub_categories', 'items.sub_categories_id', '=', 'sub_categories.id')
            ->leftJoin('categories', 'sub_categories.categories_id', '=', 'categories.id')
            ->where('items.active', '=', "1");


        if (!empty($category_id)) {
            $items_query->where('categories.id', $category_id);
        }

        if (!empty($search)) {

            $items_query->where('items.title', 'like', '%' . $search . '%');
        }






        $items_query->select('items.*', 'items.user_id as user_wishlist');

        $items = $items_query->paginate($per_page);
        // print_r($items); return;

        foreach ($items as $value) {
            $fav_items_query = DB::table('wishlists')
                ->where('wishlists.items_id', '=', $value->id)
                ->where('wishlists.user_id', '=', $addmemberid)
                ->select('wishlists.*')
                ->get();

            if (count($fav_items_query) > 0) {
                $fav_items = 1;
            } else {
                $fav_items = 0;
            }
            $value->user_wishlist = $fav_items;
        }
        // echo "<pre>";
        // print_r($request->all());
        // echo "<pre>";
        /* } else {
          $items = Items::with('user', 'cities.country', 'sub_categories.categories')->paginate($per_page);
          } */
        //$start = Items::orderBy('start_date', 'DESC')->where('items.active', '=', "1")->take(5)->get();
        //$end = Items::orderBy('end_date', 'asc')->where('items.active', '=', "1")->take(5)->get();
//        $view = Item_view::with('items')->orderBy('items.items_view', 'DESC')->take(3)->get();
        $view_counter = Items::orderBy('view_counter', 'DESC')->where('items.active', '=', "1")->take(5)->get();
        //$prices_counter = Items::Join('bids', 'bids.items_id', 'items.id')
        //  ->orderBy('bids.price', 'DESC')->where('items.active', '=', "1")->take(5)->get();

        $body_class = 'page home page-template-default';
        $latest_product = Items::orderBy('created_at', 'DESC')->where('items.active', '=', "1")->take(5)->get();


        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'items' => $items,
            //'start' => $start,
            //'end' => $end,
            'all_sub_cat' => $all_sub_cat,
            "lang" => $lang,
            'latest_product_data' => $latest_product_data,
            'all_brands' => $all_brands,
            'latest_product' => $latest_product,
            'view_counter' => $view_counter,
            'body_class' => 'page home page-template-default',
            'all_cities' => $all_cities,
            'cat_id' => $request['category_id'],
            'locale_name' => $locale_name,
            'locale_title' => $locale_title,
            'items_colors' => $items_colors,
            'items_sizes' => $items_sizes,
            "search" => $search ,
            "category_id" => $category_id ,
        ];

        if ($request->ajax()) {

            $view = view(FE . '.items_by_subcategory_load_more', compact('data'))->render();
            // return $view;
            return response()->json(['html' => $view]);
        }
//        return $data;
        return view(FE . '.categories', compact(array('data', 'all_cities', 'body_class', 'view_counter', 'search', "category_id", 'category_id','lang', "all_sub_cat", "all_brands", "latest_product", "latest_product_data",'items_colors', 'items_sizes')));
    }

    function get_sub_category(Request $request) {
//        if ($locale == "") {
//        $locale = session('sess_locale');
//        } else {
//            App::setLocale($locale);
        $locale = App::getLocale();
//        }
        $category_id = $request->input('category_id');

//        $categories = array('id' => '0', 'title' => trans('cpanel.select_category'));
        $categories = array(Array
        (
            'title' => trans('cpanel.select_sub_category'),
            'id' => ''
        ));
        $categories_data = array();
        $categories_data = Sub_categories::where('categories_id', '=', $category_id)
            ->select($locale . '_title as title', 'id')->get()->toArray();
//        print_r($categories);
//        print_r($categories_data);
//        print_r(array_merge($categories, $categories_data));
        $data = [
            'sub_categories_data' => array_merge($categories, $categories_data),
        ];

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

}

<?php

namespace App\Http\Controllers\Frontend;

use App\Items;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Categories;
use App\Messages;
use App\Sub_categories;
use App\Brands;
use App\Status;
use App\Item_images;
use App\User;
use App\Countries;
use App\Cities;
use App\Bids;
use App\Notifications;
use App\Wishlist;
use Validator;
use Auth;
use App;
use DB;
use File;
use Session;
use Carbon\Carbon;
use App\Item_view;
use App\Items_sizes;
use App\Items_colors;
use App\Colors;
use App\Specifications;
use App\Item_specifications;
use App\OrdersDetails;
class ItemsController extends Controller {

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
     * Display a listing of the resource.
     *myproducts
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $locale = session('sess_locale');
        if (!auth()->user()) {
            return redirect('/' . $locale);
        }
        $user_id = auth()->user()->id;
        $all_items = Items::where('user_id', '=', $user_id)->where('active', '=', "1")->get();
        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'all_data' => $all_items,
        ];
        return view(DSH . '.myproducts')->with($data);
      //  return view(DSH . '.items')->with($data);
    }
    public function myproducts() {
        $locale = session('sess_locale');
        if (!auth()->user()) {
            return redirect('/' . $locale);
        }
        $user_id = auth()->user()->id;
        $all_items = Items::where('user_id', '=', $user_id)->where('active', '=', "1")->get();
        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'all_data' => $all_items,
        ];

        return view(DSH . '.myproducts')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale = "") {
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }
      
        session(['numberimage' => 0]);
        $locale_name = $locale . '_name';
        $locale_title = $locale . '_title';

        $all_categories = Categories::all();
        $all_categories_arr = array('' => trans('cpanel.select_category'));
        $local_title = $locale . '_title';
        if (!empty($all_categories)) {
            foreach ($all_categories as $row_cat) {
                $all_categories_arr[$row_cat->id] = $row_cat->$local_title;
            }
        }

        $all_brands = Brands::all();

        $all_brands_arr = array('' => trans('cpanel.Select_Brand'));
        if (!empty($all_brands)) {
            foreach ($all_brands as $row_brand) {
                $all_brands_arr[$row_brand->id] = $row_brand->$local_title;
            }
        }


        $all_status = Status::all();
        $all_status_arr = [];
        if (!empty($all_status)) {
            foreach ($all_status as $row_status) {
                $all_status_arr[$row_status->id] = $row_status->$local_title;
            }
        }
        // $AutctionTypes = User::GetAutctionTypes();
        $all_colors = Colors::all();

        $my_items_colors = array();
        $states = array();
        $sub_categories_ids = array();
        $data = [
            'title' => 'site_name',
            'page_title' => 'add_admin',
            'type' => 'add',
            'form_title' => 'admin_form',
            'submit_button' => trans('cpanel.Submit_Item'),
            'category_ids' => $all_categories_arr,
            'brand_ids' => $all_brands_arr,
            'status_ids' => $all_status_arr,
            'item_country_id' => '',
            'item_category_id' => '',
            'sub_categories_ids' => $sub_categories_ids,
            'states' => $states,
            'locale' => $locale,
            'all_colors' => $all_colors,
            'my_items_colors' => $my_items_colors,
            'locale_name' => $locale_name,
            'locale_title' => $locale_title,
                //    'AutctionTypes' => $AutctionTypes,
//            'start_bid' => 0,
//            'min_bid' => 0,
//            'fixed_price' => 0,
        ];
        return view(DSH . '.items_form')->with($data);
    }


    public function uploadimage(Request $request){
   
       
        if (!empty($request->file('file'))) {
           $imageuplod=$request->file('file');
            $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';
            $folder_path = '/public/uploads/items/' . $date_path;
            $path = base_path() . $folder_path;
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }
            $file_name = date('YmdHis') . mt_rand() . '_items.' .$imageuplod->getClientOriginalExtension();
    
                if ($imageuplod->move($path, $file_name)) {
                  
                 $nuperrimage=intval(Session::get('numberimage'))+1;
                    $image = $folder_path . $file_name;
                    
                    Session::put("image$nuperrimage",$image); 
                       Session::put('numberimage',$nuperrimage); 
                       
                       
                     //  return  Session::get(1);
//                             session([$nuperrimage => $image]);
//                            session(['numberimage' => $nuperrimage]);
                
                }
            

        return response()->json(['status'=>true,'message'=>session("image$nuperrimage")]);
        }
    
}
    public function store(Request $request, $locale = "") {

        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }
        // echo $locale;
        // exit;
        $rules = [
            'title' => 'required',
            'cities_id' => 'required',
            'brands_id' => 'required',
            'sub_categories_id' => 'required',
            'status_id' => 'required',
            'ratio' => 'integer|max:80|min:0',
            // 'start_date' => 'required|date|before:end_date|after:tomorrow',
            // 'end_date' => 'required|date|after:start_date',
        
        ];


        $fixed_price = 0;
        if ($request->input('fixed_price')) {
            $rules['fixed_price'] = 'required';
            $fixed_price = $request->input('fixed_price');
        }
//        print_r($rules);
//        exit;
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'title' => 'name',
            'cities_id' => 'city',
            'brands_id' => 'brands',
            'sub_categories_id' => 'sub category',
            'status_id' => 'status',
            //  'type' => 'type',
            'fixed_price' => 'fixed price',
            'address' => 'address',
        ]);
        if ($validator->fails()) {
            session()->flash('error_msg', 'form error');
//            return $request->all();
            return back()->withInput()->withErrors($validator);
        } else {


            $id = hexdec(uniqid());
            $user_id = auth()->user()->id;
            $add = new Items;
            $add->id = $id;
            $add->user_id = $user_id;
            $add->ratio = $request->input('ratio');
            $add->feature = $request->input('feature');

            $add->cities_id = $request->input('cities_id');
            $add->brands_id = $request->input('brands_id');
            $add->sub_categories_id = $request->input('sub_categories_id');
            $add->status_id = $request->input('status_id');


            $add->title = $request->input('title');
            $add->desc = $request->input('desc');

            $add->type = 2;


            $add->fixed_price = $fixed_price;

            $add->address = $request->input('address');

            $add->active = '1';
            if ($add->ratio > 0) {
                $discount = (($fixed_price * $request->input('ratio')) / 100);
                $add->discount_price = $fixed_price - $discount;
            } else {
                $add->discount_price = $fixed_price;
            }


            if (!empty($request->file('image'))) {
                $request->file('image');
                $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';
                $folder_path = '/public/uploads/items/' . $date_path;
                $path = base_path() . $folder_path;
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true);
                }
                $file_name = date('YmdHis') . mt_rand() . '_items.' . $request->file('image')->getClientOriginalExtension();
                if ($request->file('image')->move($path, $file_name)) {
                    $img = $folder_path . $file_name;
                    $add->thumbnail_image = $img;
                }
            }
            $add->save();


            // if (!empty($request->file('image_gallery'))) {
            //     foreach ($request->file('image_gallery') as $photo) {
            //         $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';
            //         $folder_path = '/public/uploads/items/gallery/' . $date_path;
            //         $path = base_path() . $folder_path;
            //         if (!File::exists($path)) {
            //             File::makeDirectory($path, 0777, true);
            //         }
            //         $file_name = date('YmdHis') . mt_rand() . '_items_gallery.' . $photo->getClientOriginalExtension();
            //         if ($photo->move($path, $file_name)) {
            //             $img_id = hexdec(uniqid());
            //             $add_gallery = new Item_images;
            //             $add_gallery->id = $img_id;
            //             $add_gallery->items_id = $id;
            //             $add_gallery->image = $folder_path . $file_name;
            //             $add_gallery->save();
            //         }
            //     }
            // }
            for($i=1;$i<= Session::get('numberimage');$i++){
                $img_id = hexdec(uniqid());
                $add_gallery = new Item_images;
                $add_gallery->id = $img_id;
                $add_gallery->items_id = $id;
              $add_gallery->image =Session::get("image$i");//session($i);
              $add_gallery->save();
             }

            if (!empty($request->input('multi_size'))) {
                foreach ($request->input('multi_size') as $multi_size) {
                    $multi_size_id = hexdec(uniqid());
                    $add_sizes = new Items_sizes;
                    $add_sizes->id = $multi_size_id;
                    $add_sizes->item_id = $id;
                    $add_sizes->size = $multi_size;
                    $add_sizes->save();
                }
            }

            if (!empty($request->input('multi_color'))) {
                $delete_items_colors = Items_colors::where('item_id', '=', $id);
                $delete_items_colors->delete();
                foreach ($request->input('multi_color') as $multi_color) {
                    $multi_color_id = hexdec(uniqid());

                    $add_color = new Items_colors;
                    $add_color->id = $multi_color_id;
                    $add_color->item_id = $id;
                    $add_color->color_id = $multi_color;
                    $add_color->save();
                }
            }

            $specifications_data = Specifications::where('sub_categories_id', '=', $request->input('sub_categories_id'))
                    ->get();

            if (count($specifications_data) > 0) {

                foreach ($specifications_data as $value) {
                    $specifications_id = hexdec(uniqid());
                    $add_item_specifications = new Item_specifications;
                    $add_item_specifications->id = $specifications_id;
                    $add_item_specifications->item_id = $id;
                    $add_item_specifications->specification_id = $value->id;
                    $add_item_specifications->value = "";
                    $add_item_specifications->save();
                }
            }


            session()->flash('success_msg', 'Item Created Sucess');
            $locale = session('sess_locale');
            return redirect($locale . '/show_spcification/' . $id);
        }
    }

    public function show_spcification(Request $request, $locale = "", $id, $old_sub_id = 0, $new_sub_id = 0) {  //show specification in dashboard
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }
        $locale_name = $locale . '_name';
        $locale_title = $locale . '_title';

//        echo $old_sub_id . ' bbb ' . $new_sub_id;
//        return;
        if ($old_sub_id != $new_sub_id) {

            $delete_items_specifications = Item_specifications::where('item_id', '=', $id);
            $delete_items_specifications->delete();

            $specifications_data = Specifications::where('sub_categories_id', '=', $new_sub_id)
                    ->get();

            if (count($specifications_data) > 0) {

                foreach ($specifications_data as $value) {
                    $specifications_id = hexdec(uniqid());
                    $add_item_specifications = new Item_specifications;
                    $add_item_specifications->id = $specifications_id;
                    $add_item_specifications->item_id = $id;
                    $add_item_specifications->specification_id = $value->id;
                    $add_item_specifications->value = "";
                    $add_item_specifications->save();
                }
            }
//            echo count($specifications_data);
//            return;
        } else {
            $item_specifications_data = Item_specifications::where('item_id', '=', $id)
                    ->get();
            if (count($item_specifications_data) < 1) {
                $specifications_data = Specifications::where('sub_categories_id', '=', $new_sub_id)
                        ->get();

                if (count($specifications_data) > 0) {

                    foreach ($specifications_data as $value) {
                        $specifications_id = hexdec(uniqid());
                        $add_item_specifications = new Item_specifications;
                        $add_item_specifications->id = $specifications_id;
                        $add_item_specifications->item_id = $id;
                        $add_item_specifications->specification_id = $value->id;
                        $add_item_specifications->value = "";
                        $add_item_specifications->save();
                    }
                }
            }
        }

        $specifications_info = DB::table('specifications')
                ->join('item_specifications', 'item_specifications.specification_id', '=', 'specifications.id')
                ->where('item_specifications.item_id', $id)
                ->get();
        if (count($specifications_info) < 1) {
            return redirect($locale . '/dashboard/items');
        }


//   echo "<pre>";
// print_r($specifications_info2);
// echo "</pre>";
// return;

        $data = [
            'title' => 'site_name',
            'page_title' => 'add_admin',
            'form_title' => 'admin_form',
            'submit_button' => trans('cpanel.save'),
            'specifications_info' => $specifications_info,
            'item_id' => $id,
            'locale' => $locale,
            'locale_title' => $locale_title
        ];
        return view(DSH . '.v_specification')->with($data);
        //
    }

    public function spcification(Request $request, $locale = "") {

        $rules = [
            '' => '',
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            '' => '',
        ]);

        if ($validator->fails()) {
            session()->flash('error_msg', 'form error');

            return back()->withInput()->withErrors($validator);
        } else {

            $specifications_info2 = DB::table('item_specifications')
                    ->where('item_specifications.item_id', $request->input('item_id'))
                    ->get();


            //  return $request->input('item_id');

            foreach ($specifications_info2 as $value) {

                $edit = Item_specifications::findOrFail($value->id);

                $edit->value = $request->input('item_specification_' . $value->id);
                $edit->save();
            }

            session()->flash('success_msg', 'brand Created Sucess');
            return redirect($locale . '/dashboard/items');
        }
    }

    public function show($locale = "", $id) {
//      echo $id; return;
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }

        $locale_name = $locale . '_name';
        $locale_title = $locale . '_title';

        $admin_data = Items::with('user', 'cities.country', 'sub_categories.categories', 'brands','accessories.items')->findOrFail($id);


  //    return $admin_data;
       

        $related_products = Items::with('user', 'cities.country', 'sub_categories.categories')
                ->where('items.active', '=', "1")
                ->where('sub_categories_id', '=', $admin_data->sub_categories->id)
                ->where('id', '!=', $admin_data->id)
                ->select('items.*', 'items.user_id as user_wishlist')
                ->paginate(5);

        if (auth()->user()) {
            $addmemberid = auth()->user()->id;
        } else {
            $addmemberid = 0;
        }

        foreach ($related_products as $value) {
            $fav_items_query = DB::table('wishlists')
                    ->where('wishlists.items_id', '=', $value->id)
                    ->where('wishlists.user_id', '=', auth()->id())
                    ->select('wishlists.*')
                    ->get();

            if (count($fav_items_query) > 0) {
                $fav_items = 1;
            } else {
                $fav_items = 0;
            }
            $value->user_wishlist = $fav_items;
        }
//return $related_products ;


        if (auth()->user()) {
            $addmemberid = auth()->user()->id;
        } else {
            $addmemberid = 0;
        }

        $wishlists = DB::table('wishlists')
                ->where('wishlists.user_id', '=', $addmemberid)
                ->where('wishlists.items_id', '=', $id)
                ->count();

        $reviews_count_5 = DB::table('reviews')
                ->where('reviews.rate', '=', '5')
                ->where('reviews.items_id', '=', $id)
                ->count();
        $reviews_count_4 = DB::table('reviews')
                ->where('reviews.rate', '=', '4')
                ->where('reviews.items_id', '=', $id)
                ->count();

        $reviews_count_3 = DB::table('reviews')
                ->where('reviews.rate', '=', '3')
                ->where('reviews.items_id', '=', $id)
                ->count();

        $reviews_count_2 = DB::table('reviews')
                ->where('reviews.rate', '=', '2')
                ->where('reviews.items_id', '=', $id)
                ->count();
        $reviews_count_1 = DB::table('reviews')
                ->where('reviews.rate', '=', '1')
                ->where('reviews.items_id', '=', $id)
                ->count();


     $item_specifications =DB::table('specifications')
                ->join('item_specifications', 'item_specifications.specification_id', '=', 'specifications.id')
                ->where('item_specifications.item_id', $id)
                ->get();
            

        $data = [
            'title' => 'site_name',
            'page_title' => 'add_admin',
            'form_title' => 'admin_form',
            'submit_button' => 'save',
            'body_class' => 'single-product full-width extended',
            'admin_data' => $admin_data,
            'locale' => $locale,
            'locale_name' => $locale_name,
            'locale_title' => $locale_title,
            'id' => $id,
            'wishlists' => $wishlists,
            'related_products' => $related_products,
            'reviews_count_5' => $reviews_count_5,
            'reviews_count_4' => $reviews_count_4,
            'reviews_count_3' => $reviews_count_3,
            'reviews_count_2' => $reviews_count_2,
            'reviews_count_1' => $reviews_count_1,
            'item_specifications'=>$item_specifications,
        ];
        return view(FE . '.items_show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale = "", $id) {
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }
        $locale_name = $locale . '_name';
        $locale_title = $locale . '_title';

      
        session(['numberimage' => 0]);


        $all_categories = Categories::all();
        $all_categories_arr = array('' => trans('cpanel.select_category'));
        $local_title = $locale . '_title';
        if (!empty($all_categories)) {
            foreach ($all_categories as $row_cat) {
                $all_categories_arr[$row_cat->id] = $row_cat->$local_title;
            }
        }

        $all_brands = Brands::all();
        $all_brands_arr = [];
        if (!empty($all_brands)) {
            foreach ($all_brands as $row_brand) {
                $all_brands_arr[$row_brand->id] = $row_brand->$local_title;
            }
        }


        $all_status = Status::all();
        $all_status_arr = [];
        if (!empty($all_status)) {
            foreach ($all_status as $row_status) {
                $all_status_arr[$row_status->id] = $row_status->$local_title;
            }
        }


        $admin_data = Items::with('user', 'cities.country', 'sub_categories.categories')->findOrFail($id);

        $states = array();
        $all_states = Cities::where('country_id', '=', $admin_data->cities->country->id)
                ->get();

        foreach ($all_states as $state) {
            $states[$state->id] = $state->$locale_name;
        }

        $sub_categories_ids = array();
        $all_sub_categories = Sub_categories::where('categories_id', '=', $admin_data->sub_categories->categories->id)
                ->get();

        foreach ($all_sub_categories as $sub_category) {
            $sub_categories_ids[$sub_category->id] = $sub_category->$locale_title;
        }

        $all_colors = Colors::all();

        $my_items_colors = array();
        $my_items_colors_arr = $admin_data->items_colors;
        if (!empty($my_items_colors_arr)) {
            foreach ($my_items_colors_arr as $row_color) {
                $my_items_colors[$row_color->id] = $row_color->color_id;
            }
        }


        $data = [
            'title' => 'site_name',
            'page_title' => 'add_admin',
            'form_title' => 'admin_form',
            'submit_button' => trans('cpanel.save'),
            'admin_data' => $admin_data,
//            'items_images' => $items_images,
//            'items_sizes' => $items_sizes,
            'type' => 'edit',
            'category_ids' => $all_categories_arr,
            'brand_ids' => $all_brands_arr,
            'status_ids' => $all_status_arr,
            'item_country_id' => $admin_data->cities->country->id,
            'item_category_id' => $admin_data->sub_categories->categories->id,
            'sub_categories_ids' => $sub_categories_ids,
            'states' => $states,
            'locale' => $locale,
            'locale_name' => $locale_name,
            'locale_title' => $locale_title,
            'all_colors' => $all_colors,
            'my_items_colors' => $my_items_colors,
                // 'AutctionTypes' => $AutctionTypes,
        ];
        return view(DSH . '.items_form')->with($data);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $locale = "", $id) {

    
        $rules = [
            'title' => 'required',
            'cities_id' => 'required',
            'brands_id' => 'required',
            'sub_categories_id' => 'required',
            'status_id' => 'required',
            'ratio' => 'integer|max:80|min:0',
       
        ];


        $fixed_price = 0;
        if ($request->input('fixed_price')) {
            $rules['fixed_price'] = 'required';
            $fixed_price = $request->input('fixed_price');
        }

        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'title' => 'name',
            'cities_id' => 'city',
            'brands_id' => 'brands',
            'sub_categories_id' => 'sub category',
            'status_id' => 'status',
            'fixed_price' => 'fixed price',
         
        ]);




        if ($validator->fails()) {
            session()->flash('error_msg', 'form error');
            // return $request->all();
            return back()->withInput()->withErrors($validator);
        } else {
            $item_old = Items::findOrFail($id);
            $edit = Items::findOrFail($id);

            $edit->cities_id = $request->input('cities_id');
            $edit->brands_id = $request->input('brands_id');
            $edit->sub_categories_id = $request->input('sub_categories_id');
            $edit->status_id = $request->input('status_id');


            $edit->title = $request->input('title');
            $edit->desc = $request->input('desc');
            $edit->ratio = $request->input('ratio');
            $edit->feature = $request->input('feature');
            $edit->type = 2;

            $edit->fixed_price = $fixed_price;
            $edit->address = $request->input('address');

            $edit->active = '1';

            if ($edit->ratio > 0) {
                $discount = (($fixed_price * $edit->ratio) / 100);
                $edit->discount_price = $fixed_price - $discount;
            } else {
                $edit->discount_price = $fixed_price;
            }
            if (!empty($request->file('image'))) {
                $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';

                $folder_path = '/public/uploads/items/' . $date_path;
                $path = base_path() . $folder_path;
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true);
                }
                $file_name = date('YmdHis') . mt_rand() . '_items.' . $request->file('image')->getClientOriginalExtension();
                if ($request->file('image')->move($path, $file_name)) {
                    $img = $folder_path . $file_name;
                    $edit->thumbnail_image = $img;
                }
            }
            $edit->save();


            // print_r($request->file('image_gallery'));
            // if (!empty($request->file('image_gallery'))) {
            //     foreach ($request->file('image_gallery') as $photo) {
            //         $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';

            //         $folder_path = '/public/uploads/items/gallery/' . $date_path;
            //         $path = base_path() . $folder_path;
            //         if (!File::exists($path)) {
            //             File::makeDirectory($path, 0777, true);
            //         }

            //         $file_name = date('YmdHis') . mt_rand() . '_items_gallery.' . $photo->getClientOriginalExtension();
            //         if ($photo->move($path, $file_name)) {
            //             $img_id = hexdec(uniqid());
            //             $add = new Item_images;
            //             $add->id = $img_id;
            //             $add->items_id = $id;
            //             $add->image = $folder_path . $file_name;
            //             $add->save();
            //         }
            //     }
            // }


            for($i=1;$i<= session('numberimage');$i++){
                $img_id = hexdec(uniqid());
                $add_gallery = new Item_images;
                $add_gallery->id = $img_id;
                $add_gallery->items_id = $id;
              $add_gallery->image =Session::get("image$i");//session($i);
              $add_gallery->save();
             }
            if (!empty($request->input('multi_size'))) {
                $delete_items_size = Items_sizes::where('item_id', '=', $id);
                $delete_items_size->delete();
                foreach ($request->input('multi_size') as $multi_size) {
                    if($multi_size){
                        $multi_size_id = hexdec(uniqid());
                        $add_sizes = new Items_sizes;
                        $add_sizes->id = $multi_size_id;
                        $add_sizes->item_id = $id;
                        $add_sizes->size = $multi_size;
                        $add_sizes->save();
                    }
                 
                }
            }

            if (!empty($request->input('multi_color'))) {
                $delete_items_colors = Items_colors::where('item_id', '=', $id);
                $delete_items_colors->delete();
                foreach ($request->input('multi_color') as $multi_color) {
                    $multi_color_id = hexdec(uniqid());
                    $add_color = new Items_colors;
                    $add_color->id = $multi_color_id;
                    $add_color->item_id = $id;
                    $add_color->color_id = $multi_color;
                    $add_color->save();
                }
            }

            session()->flash('success_msg', 'brand Created Sucess');
            // return redirect($locale . '/dashboard/items');
            $locale = session('sess_locale');

            return redirect($locale . '/show_spcification/' . $id . '/' . $item_old->sub_categories_id . '/' . $request->input('sub_categories_id'));
        }
    }


    public function myordervendor($locale){
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }
        if (!auth()->user()) {
            return redirect($locale.'/login');
        } 

        $vendor_id = auth()->user()->id;
        $orders = OrdersDetails::Join('orders','order_details.order_id','orders.id')
                   ->Join('users','orders.user_id','users.id')
                   ->where('order_details.vendor_id', $vendor_id)
                  ->orderBy('orders.created_at', 'desc')
                  ->groupby('order_details.order_id')
                  ->select('users.name','orders.id',DB::raw('sum(order_details.price *order_details.count) as sum'), DB::raw('DATE_FORMAT(orders.created_at, "%Y/%m/%d") as date'))
                  ->get();


        
          $data = [
         'title' => trans('cpanel.site_name'),

         'orders' => $orders,
         'locale' => $locale,
       
     ];
     return view(DSH .'.myordervendor')->with($data);
    }

    public function myorderDetails($locale,$order_id){


   
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }
        if (!auth()->user()) {
            return redirect($locale.'/login');
        } 

        $vendor_id = auth()->user()->id;
        $orders = OrdersDetails::Join('orders','order_details.order_id','orders.id')
                   ->Join('users','orders.user_id','users.id')
                   ->Join('addresses','orders.address_id','addresses.id')
               
                   ->Join('regions','addresses.region_id','regions.id')
                   ->Join('cities','regions.city_id','cities.id')
                   ->where('order_details.vendor_id', $vendor_id)
                   ->where('order_details.order_id', $order_id)
           
                  ->groupby('order_details.order_id')
                  ->select('users.name','orders.id','addresses.address','addresses.floor_number','addresses.unit_number','orders.payment','cities.'.$locale.'_name as cityname','regions.'.$locale.'_name as regonname','orders.order_number',DB::raw('sum(order_details.price *order_details.count) as sum'),DB::raw('count(order_details.id) as count'), DB::raw('DATE_FORMAT(orders.created_at, "%Y/%m/%d") as date'))
                  ->first();


                  $ordersdetails = OrdersDetails::
                  where('order_details.vendor_id', $vendor_id)
                  ->where('order_details.order_id', $order_id)
                 ->get();

                  
        
          $data = [
         'title' => trans('cpanel.site_name'),

         'order' => $orders,

         'ordersdetails' => $ordersdetails,
         'locale' => $locale,
       
     ];
     return view(DSH .'.myorderDetails')->with($data); 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($locale = "ar") {
$id=request('row');
        $delete = Items::findOrFail($id);
        $delete->delete();
        if ($delete == true) {
            $delete_items_images = Item_images::where('items_id', '=', $id);
            $delete_items_images->delete();

            $delete_items_colors = Items_colors::where('item_id', '=', $id);
            $delete_items_colors->delete();

            $delete_items_sizes = Items_sizes::where('item_id', '=', $id);
            $delete_items_sizes->delete();

            // Session::flash('message', trans('cpanel.Delete_success'));
            // Session::flash('alert-class', 'alert-success');
            return "done";
        }
    }

    public function message(Request $request, $locale = "") {
        // echo"dddd" ;return;

        App::setLocale($locale);
        $locale = App::getLocale();
        $rules = [
            'message' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'message' => 'message',
        ]);
        if ($validator->fails()) {
            // Session::flash('error_msg',  trans('cpanel.form_error'));
            // Session::flash('alert-class', 'alert-danger');



            return back()->withInput()->withErrors($validator);
        } else {
// print_r($request->all());
// return
            $user_login = auth()->user()->id;


            $add = new Messages;

            $add->id = hexdec(uniqid());
            $add->message = $request->input('message');
            $add->sender_id = $user_login;
            $add->receiver_id = $request->input('receiver_id');
            $add->delete = 0;

            $add->save();

            $data = [
                'msg' => 'success',
            ];

            return response($data, 200)->header('Content-Type', 'text/plain');
        }
    }

    public function bid(Request $request, $locale = "") { //Auction Case
        App::setLocale($locale);
        $locale = App::getLocale();
        $rules = [
            'price' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'price' => 'price',
        ]);
        if ($validator->fails()) {
            // Session::flash('error_msg',  trans('cpanel.form_error'));
            // Session::flash('alert-class', 'alert-danger');

            return back()->withInput()->withErrors($validator);
        } else {

            $user_login = auth()->user()->id;

            $add = new Bids;
            $add->id = hexdec(uniqid());
            $add->price = $request->input('price');
            $add->users_id = $user_login;
            $add->items_id = $request->input('items_id');

            $add->save();

            if ($add->save() == true) {

                $addproductid = $request->input('items_id');

                $users_ids = array();
                $bids = array();
                $users_ids_sections = array();
                $item_user_id = array();
                $item_user_id = array($request->input('item_user_id'));

                $bids = DB::table('bids')
                        ->where('bids.users_id', '!=', $user_login)
                        ->where('bids.items_id', '=', $addproductid)
                        ->get();

                if (!empty($bids)) {
                    foreach ($bids as $key => $value_user_ids) {
                        $users_ids_sections[] = $value_user_ids->users_id;
                    }
                }
                $users_ids = array_merge($users_ids, $users_ids_sections, $item_user_id);
                $users_ids_unique = array_unique($users_ids);

                foreach ($users_ids_unique as $key => $value) {

                    $addToNotification = new Notifications;

                    $addToNotification->id = hexdec(uniqid());
                    $addToNotification->price = $request->input('price');
                    $addToNotification->delete = 0;
                    $addToNotification->notification = "Added_a_bid_with_value";
                    $addToNotification->items_id = $request->input('items_id');
                    $addToNotification->sender_id = $user_login;
                    $addToNotification->receiver_id = $value;
                    $addToNotification->save();
                }
//   echo "<pre>";
// print_r($users_ids_unique);
// echo "</pre>";
// return;
            }

            $data = [
                'msg' => 'success',
            ];

            return response($data, 200)->header('Content-Type', 'text/plain');
        }//end of else
    }

    public function accept_bid(Request $request, $locale = "") { //Fixed Case
// echo "ujj"; return;
        App::setLocale($locale);
        $locale = App::getLocale();
        $rules = [
            'price' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'price' => 'price',
        ]);
        if ($validator->fails()) {
            // Session::flash('error_msg',  trans('cpanel.form_error'));
            // Session::flash('alert-class', 'alert-danger');

            return back()->withInput()->withErrors($validator);
        } else {

            $user_login = auth()->user()->id;
            $add = new Bids;
            $add->id = hexdec(uniqid());
            $add->price = $request->input('price');
            $add->users_id = $user_login;
            $add->items_id = $request->input('items_id');


            $add->save();


            if ($add->save() == true) {

                $addproductid = $request->input('items_id');

                $bids = array();
                $users_ids_sections = array();
                $users_ids = array();
                $item_user_id = array();
                $item_user_id = array($request->input('item_user_id'));

                $bids = DB::table('bids')
                        ->where('bids.users_id', '!=', $user_login)
                        ->where('bids.items_id', '=', $addproductid)
                        ->get();
                //   echo "<pre>";
                // print_r($bids);
                // echo "</pre>";
                // return;

                if (!empty($bids)) {
                    foreach ($bids as $key => $value_user_ids) {
                        $users_ids_sections[] = $value_user_ids->users_id;
                    }
                }
                $users_ids = array_merge($users_ids, $users_ids_sections, $item_user_id);
                $users_ids_unique = array_unique($users_ids);

                foreach ($users_ids_unique as $key => $value) {

                    $addToNotification = new Notifications;

                    $addToNotification->id = hexdec(uniqid());
                    $addToNotification->price = $request->input('price');
                    $addToNotification->delete = 0;
                    $addToNotification->notification = "Want_to_buy_item_with_value";
                    $addToNotification->items_id = $request->input('items_id');
                    $addToNotification->sender_id = $user_login;
                    $addToNotification->receiver_id = $value;
                    $addToNotification->save();
                }

                // }//end of empty
// //   echo "<pre>";
// // print_r($users_ids_unique);
// // echo "</pre>";
// // return;
            }


            $data = [
                'msg' => 'success',
            ];

            return response($data, 200)->header('Content-Type', 'text/plain');
        }//end of else
    }

}

<?php

namespace App\Http\Controllers\Administrator;

use App\Items;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Categories;
use App\Brands;
use App\Item_images;
use App\Items_sizes;
use App\Items_colors;
use Validator;
use Auth;
use App;
use DB;
use File;
use Carbon\Carbon;

class ItemsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if (!auth()->user()) {
            return redirect('admin/admin-login');
        }

        // $all_items = Items::all()->paginate(5);

        $per_page = 10;
        $all_items = Items::with('user', 'cities.country', 'sub_categories.categories')//1 auction
                        ->where('items.type', '=', '1')
                        ->orderBy('created_at', 'desc')->paginate($per_page);

        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'all_data' => $all_items,
        ];

        return view(AD . '.items')->with($data);
    }

    public function fixed() {

        if (!auth()->user()) {
            return redirect('admin/admin-login');
        }

        // $all_items = Items::all()->paginate(5);

        $per_page = 10;
        $all_items = Items::with('user', 'cities.country', 'sub_categories.categories')//2 fixed
                        ->where('items.type', '=', '2')
                        ->orderBy('created_at', 'desc')->paginate($per_page);

        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'all_data' => $all_items,
        ];

        return view(AD . '.items_fixed')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $all_categories = Categories::all();
        $all_categories_arr = [];
        if (!empty($all_categories)) {
            foreach ($all_categories as $row_cat) {
                $all_categories_arr[$row_cat->id] = $row_cat->title;
            }
        }

        $all_brands = Brands::all();
        $all_brands_arr = [];
        if (!empty($all_brands)) {
            foreach ($all_brands as $row_brand) {
                $all_brands_arr[$row_brand->id] = $row_brand->title;
            }
        }

        $gender_types = gender_types();

        $data = [
            'title' => 'site_name',
            'page_title' => 'add_admin',
            'type' => 'add',
            'form_title' => 'admin_form',
            'submit_button' => 'save',
            'category_ids' => $all_categories_arr,
            'brand_ids' => $all_brands_arr,
            'gender_types' => $gender_types,
        ];
        return view(AD . '.items_form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $rules = [
            'title' => 'required',
            'image' => 'required',
            'model_num' => 'required',
            'price' => 'required',
            'availability' => 'required',
            'color' => 'required',
            'size' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'title' => 'name',
            'image' => 'image must upload ',
            'model_num' => 'model number ',
            'price' => 'price ',
            'availability' => 'availability ',
            'color' => 'color ',
            'size' => 'size ',
        ]);
        if ($validator->fails()) {
            session()->flash('error_msg', 'form error');
            //  return $request->all();
            return back()->withInput()->withErrors($validator);
        } else {
            $id = hexdec(uniqid());
            $add = new Items;
            $add->id = $id;
            $add->title = $request->input('title');
            $add->desc = $request->input('desc');
            $add->brand_id = $request->input('brand_id');
            $add->category_id = $request->input('category_id');
            $add->gender_type = $request->input('gender_type');
            $add->model_num = $request->input('model_num');
            $add->price = $request->input('price');
            $add->availability = $request->input('availability');
            $add->color = $request->input('color');
            $add->size = $request->input('size');

            $add->active = $request->input('active');

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


            if (!empty($request->file('image_gallery'))) {
                foreach ($request->file('image_gallery') as $photo) {
                    $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';
                    $folder_path = '/public/uploads/items/gallery/' . $date_path;
                    $path = base_path() . $folder_path;
                    if (!File::exists($path)) {
                        File::makeDirectory($path, 0777, true);
                    }
                    $file_name = date('YmdHis') . mt_rand() . '_items_gallery.' . $photo->getClientOriginalExtension();
                    if ($photo->move($path, $file_name)) {
                        $img_id = hexdec(uniqid());
                        $add_gallery = new Item_images;
                        $add_gallery->id = $img_id;
                        $add_gallery->item_id = $id;
                        $add_gallery->image = $folder_path . $file_name;
                        $add_gallery->save();
                    }
                }
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
                foreach ($request->input('multi_color') as $multi_color) {
                    $multi_color_id = hexdec(uniqid());
                    $add_sizes = new Items_colors;
                    $add_sizes->id = $multi_color_id;
                    $add_sizes->item_id = $id;
                    $add_sizes->color = $multi_color;
                    $add_sizes->active = 1;
                    $add_sizes->save();
                }
            }

            session()->flash('success_msg', 'brand Created Sucess');
            return redirect('admin/items');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $all_categories = Categories::all();
        $all_categories_arr = [];
        if (!empty($all_categories)) {
            foreach ($all_categories as $row_cat) {
                $all_categories_arr[$row_cat->id] = $row_cat->title;
            }
        }

        $all_brands = Brands::all();
        $all_brands_arr = [];
        if (!empty($all_brands)) {
            foreach ($all_brands as $row_brand) {
                $all_brands_arr[$row_brand->id] = $row_brand->title;
            }
        }

        $gender_types = gender_types();

        $admin_data = Items::findOrFail($id);
//        print_r($admin_data->items_images);
//        $items_images = Item_images::where('item_id', '=', $id)->get();
//        $items_sizes = Items_sizes::where('item_id', '=', $id)->get();
//        print_r($items_images);
//        exit;
        $data = [
            'title' => 'site_name',
            'page_title' => 'add_admin',
            'form_title' => 'admin_form',
            'submit_button' => 'save',
            'admin_data' => $admin_data,
//            'items_images' => $items_images,
//            'items_sizes' => $items_sizes,
            'type' => 'edit',
            'category_ids' => $all_categories_arr,
            'brand_ids' => $all_brands_arr,
            'gender_types' => $gender_types,
        ];
        return view(AD . '.items_form')->with($data);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $rules = [
            'title' => 'required',
            'model_num' => 'required',
            'price' => 'required',
            'availability' => 'required',
            'color' => 'required',
            'size' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'title' => 'name',
            'model_num' => 'model number ',
            'price' => 'price ',
            'availability' => 'availability ',
            'color' => 'color ',
            'size' => 'size ',
        ]);
        if ($validator->fails()) {
            session()->flash('error_msg', 'form error');
            //  return $request->all();
            return back()->withInput()->withErrors($validator);
        } else {
//            echo '<br/>';

            $edit = Items::findOrFail($id);
            $edit->title = $request->input('title');
            $edit->desc = $request->input('desc');
            $edit->brand_id = $request->input('brand_id');
            $edit->category_id = $request->input('category_id');
            $edit->gender_type = $request->input('gender_type');
            $edit->model_num = $request->input('model_num');
            $edit->price = $request->input('price');
            $edit->availability = $request->input('availability');
            $edit->color = $request->input('color');
            $edit->size = $request->input('size');

            $edit->active = $request->input('active');

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
            if (!empty($request->file('image_gallery'))) {
                foreach ($request->file('image_gallery') as $photo) {
                    $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';

                    $folder_path = '/public/uploads/items/gallery/' . $date_path;
                    $path = base_path() . $folder_path;
                    if (!File::exists($path)) {
                        File::makeDirectory($path, 0777, true);
                    }

                    $file_name = date('YmdHis') . mt_rand() . '_items_gallery.' . $photo->getClientOriginalExtension();
                    if ($photo->move($path, $file_name)) {
                        $img_id = hexdec(uniqid());
                        $add = new Item_images;
                        $add->id = $img_id;
                        $add->item_id = $id;
                        $add->image = $folder_path . $file_name;
                        $add->save();
                    }
                }
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
                foreach ($request->input('multi_color') as $multi_color) {
                    $multi_color_id = hexdec(uniqid());
                    $add_sizes = new Items_colors;
                    $add_sizes->id = $multi_color_id;
                    $add_sizes->item_id = $id;
                    $add_sizes->color = $multi_color;
                    $add_sizes->active = 1;
                    $add_sizes->save();
                }
            }
            session()->flash('success_msg', 'brand Created Sucess');
            return redirect('admin/items');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $delete = Items::findOrFail($id);
        $delete->delete();

        $delete_items_sizes = Items_sizes::where('item_id', '=', $id);
        $delete_items_sizes->delete();

        $delete_items_colors = Items_colors::where('item_id', '=', $id);
        $delete_items_colors->delete();

        $delete_items_images = Item_images::where('item_id', '=', $id);
        $delete_items_images->delete();

        session()->flash('success_msg', 'Deleted Sucess');
        return back();
    }

    public function update_active_item(Request $request, $id) {

        $active = $request->input('active');
        if ($active == 1) {
            $item_active = 0;
        } else {
            $item_active = 1;
        }

        $edit = Items::findOrFail($id);
        $edit->active = $item_active;
        $edit->save();
        return back();
    }

}

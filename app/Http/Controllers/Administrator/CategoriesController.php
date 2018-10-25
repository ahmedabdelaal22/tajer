<?php

namespace App\Http\Controllers\Administrator;

use App\Categories;
use App\Sub_categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Cart_items;
use App\Fav_items;
use Validator;
use Auth;
use App;
use DB;
use File;
use Carbon\Carbon;

class CategoriesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if (!auth()->user()) {
            return redirect('admin/admin-login');
        }

        $all_categories = Categories::all();
        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'all_data' => $all_categories,
        ];

        return view(AD . '.categories')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data = [
            'title' => 'site_name',
            'page_title' => 'add_admin',
            'type' => 'add',
            'form_title' => 'admin_form',
            'submit_button' => 'save',
        ];
        return view(AD . '.categories_form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = [
            'ar_title' => 'required',
            'en_title' => 'required',
                //  'image' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'ar_title' => 'ar title',
            'en_title' => 'en title',
                //   'image' => 'image must upload '
        ]);
        if ($validator->fails()) {
            session()->flash('error_msg', 'form error');
            //  return $request->all();
            return back()->withInput()->withErrors($validator);
        } else {
            $id = hexdec(uniqid());
            $add = new Categories;
            $add->id = $id;
            $add->ar_title = $request->input('ar_title');
            $add->en_title = $request->input('en_title');

            $add->active = $request->input('active');

            if (!empty($request->file('image'))) {
                $request->file('image');
                $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';
                $path = public_path() . '/uploads/categories/' . $date_path;
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true);
                }
                $file_name = date('YmdHis') . mt_rand() . '_user_img.' . $request->file('image')->getClientOriginalExtension();
                if ($request->file('image')->move($path, $file_name)) {
                    $img = 'public/uploads/categories/' . $date_path . $file_name;
                    $add->image = $img;
                }
            }
            $add->save();

            session()->flash('success_msg', 'brand Created Sucess');
            return redirect('admin/admin-categories');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories, $cat_id) {
        $locale = session('sess_locale');
        if (!auth()->user()) {
            return redirect($locale . '/login');
        }

        $all_sub_categories = Sub_categories::where('categories_id', '=', $cat_id)->get();
        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'categories_id' => $cat_id,
            'all_data' => $all_sub_categories,
        ];

        return view(AD . '.sub_categories')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories, $id) {
        $admin_data = Categories::findOrFail($id);
        $data = [
            'title' => 'site_name',
            'page_title' => 'add_admin',
            'form_title' => 'admin_form',
            'submit_button' => 'save',
            'admin_data' => $admin_data,
            'type' => 'edit',
        ];
        return view(AD . '.categories_form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $rules = [
            'ar_title' => 'required',
            'en_title' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'ar_title' => 'ar title',
            'en_title' => 'en title',
        ]);
        if ($validator->fails()) {
            session()->flash('error_msg', 'form error');
            //  return $request->all();
            return back()->withInput()->withErrors($validator);
        } else {

            $edit = Categories::findOrFail($id);
            $edit->ar_title = $request->input('ar_title');
            $edit->en_title = $request->input('en_title');
            $edit->active = $request->input('active');

            if (!empty($request->file('image'))) {
                $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';
                $path = public_path() . '/uploads/categories/' . $date_path;
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true);
                }
                $file_name = date('YmdHis') . mt_rand() . '_user_img.' . $request->file('image')->getClientOriginalExtension();
                if ($request->file('image')->move($path, $file_name)) {
                    $img = 'public/uploads/categories/' . $date_path . $file_name;
                    $edit->image = $img;
                }
            }
            $edit->save();

            session()->flash('success_msg', 'brand Created Sucess');
            return redirect('admin/admin-categories');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $delete = Categories::findOrFail($id);
        $delete->delete();
        session()->flash('success_msg', 'Deleted Sucess');
        return back();
    }

}

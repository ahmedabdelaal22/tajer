<?php

namespace App\Http\Controllers\Administrator;

use App\Specifications;
use Illuminate\Http\Request;
use App\Categories;
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

class SpecificationsController extends Controller {

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

        return view(AD . '.specifications')->with($data);
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
        return view(AD . '.specifications_form')->with($data);
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
            $add = new Specifications;
            $add->id = $id;
            $add->sub_categories_id = $request->input('sub_categories_id');
            $add->ar_title = $request->input('ar_title');
            $add->en_title = $request->input('en_title');

            $add->save();

            session()->flash('success_msg', 'brand Created Sucess');
            return redirect('admin/sub_categories/' . $request->input('sub_categories_id'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Specifications  $specifications
     * @return \Illuminate\Http\Response
     */
    public function show(Specifications $specifications) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Specifications  $specifications
     * @return \Illuminate\Http\Response
     */
    public function edit(Specifications $specifications, $id) {

        $admin_data = Specifications::findOrFail($id);
        $data = [
            'title' => 'site_name',
            'page_title' => 'add_admin',
            'form_title' => 'admin_form',
            'submit_button' => 'save',
            'sub_categories_id' => $admin_data->sub_categories_id,
            'admin_data' => $admin_data,
            'type' => 'edit',
        ];
        return view(AD . '.specifications_form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specifications  $specifications
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

            $edit = Specifications::findOrFail($id);
            $edit->ar_title = $request->input('ar_title');
            $edit->en_title = $request->input('en_title');

            $edit->save();

            session()->flash('success_msg', 'brand Created Sucess');
            return redirect('admin/sub_categories/' . $edit->sub_categories_id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Specifications  $specifications
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $delete = Specifications::findOrFail($id);
        $delete->delete();
        session()->flash('success_msg', 'Deleted Sucess');
        return back();
    }

}

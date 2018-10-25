<?php

namespace App\Http\Controllers\Administrator;

use App\Colors;
use App\Items_colors;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Validator;
use Auth;
use App;
use DB;
use File;
use Carbon\Carbon;

class ColorsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        if (!auth()->user()) {
            return redirect('admin/admin-login');
        }

        $all_colors = Colors::all();
        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'all_data' => $all_colors,
        ];

        return view(AD . '.colors')->with($data);
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
        return view(AD . '.colors_form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = [
            'ar_name' => 'required',
            'en_name' => 'required',
                //  'image' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'ar_name' => 'ar  Color Name',
            'en_name' => 'en  Color Name',
                //   'image' => 'image must upload '
        ]);
        if ($validator->fails()) {
            session()->flash('error_msg', 'form error');
            //  return $request->all();
            return back()->withInput()->withErrors($validator);
        } else {
            $id = hexdec(uniqid());
            $add = new Colors;
            $add->id = $id;
            $add->ar_name = $request->input('ar_name');
            $add->en_name = $request->input('en_name');
            $add->color = $request->input('color');

            $add->active = $request->input('active');

            $add->save();

            session()->flash('success_msg', 'brand Created Sucess');
            return redirect('admin/admin-colors');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function show(Colors $colors, $cat_id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function edit(Colors $colors, $id) {
        $admin_data = Colors::findOrFail($id);
        $data = [
            'title' => 'site_name',
            'page_title' => 'add_admin',
            'form_title' => 'admin_form',
            'submit_button' => 'save',
            'admin_data' => $admin_data,
            'type' => 'edit',
        ];
        return view(AD . '.colors_form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $rules = [
            'ar_name' => 'required',
            'en_name' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'ar_name' => 'ar  Color Name',
            'en_name' => 'en  Color Name',
        ]);
        if ($validator->fails()) {
            session()->flash('error_msg', 'form error');
            //  return $request->all();
            return back()->withInput()->withErrors($validator);
        } else {

            $edit = Colors::findOrFail($id);
            $edit->ar_name = $request->input('ar_name');
            $edit->en_name = $request->input('en_name');
            $edit->color = $request->input('color');
            $edit->active = $request->input('active');
            $edit->save();

            session()->flash('success_msg', 'brand Created Sucess');
            return redirect('admin/admin-colors');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Colors  $colors
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $delete = Colors::findOrFail($id);
        $delete->delete();
        session()->flash('success_msg', 'Deleted Sucess');
        return back();
    }

}

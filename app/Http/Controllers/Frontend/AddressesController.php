<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Countries;
use App\Cities;
use App\Region;
use App\Address;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Validator;
use Auth;
use App;

use DB;
use File;



use Response;


class AddressesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($locale) {


                if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }
        if (!auth()->user()) {
            return redirect($locale.'login');
        }

        $id = auth()->user()->id;
        $locale_name = $locale . '_name';
        $admin_data = User::with('cities')->findOrFail($id);
//        print_r($admin_data->cities->id);
//        return;

        $all_states = array();
        $states = array();
        $selected_user_country_id = 0;
        $regions = [] ;

        if (!empty($admin_data->cities) > 0) {
            $selected_user_country_id = $admin_data->cities->country_id;

            $all_states = Cities::where('country_id', '=', $selected_user_country_id)
                    ->get();

            foreach ($all_states as $state) {
                $states[$state->id] = $state->$locale_name;
            }

            $all_regions = Region::where("city_id", "=" , $admin_data->cities->id)->get() ;


            foreach ($all_regions as $region){
                $regions[$region->id] = $region->$locale_name ;
            }
        }


        $data = [
          'title' => trans('cpanel.site_name'),
          'admin_data' => $admin_data,

            'user_country_id' => $selected_user_country_id,
            'states' => $states,
            "regions" => $regions,
            'locale' => $locale

        ];
        return view(FE . '.addresses_form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$locale) {


                if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }

        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'floor_number' => 'required',
            'unit_number' => 'required',
            'region' => 'required',
            

        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'name' => 'name',
            'phone' => 'phone',
            'address' => 'address',
            'floor_number' => 'floor_number',
            'unit_number' => 'unit_number',
            'region' => 'region_id',
      
        ]);
        if ($validator->fails()) {
            session()->flash('error_msg', 'form error');
            //  return $request->all();
            return back()->withInput()->withErrors($validator);
        } else {

           $user_id = auth()->user()->id;
            $id = hexdec(uniqid());
            $add = new Address;
            $add->id =  $id;
            $add->name =$request->input('name');
            $add->address = $request->input('address');
            $add->phone = $request->input('phone');
            $add->floor_number = $request->input('floor_number');
            $add->unit_number = $request->input('unit_number');
            $add->region_id = $request->input('region');
            $add->user_id = $user_id;

            $add->save();

            session()->flash('success_msg', 'Address Created Success');
             Session::flash('alert-class', 'alert-success');
            return redirect($locale.'/payment');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($locale, $id) {
        if (!auth()->user()) {
            return redirect('login');
        }

        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }


        $address = Address::find($id) ;

        if(empty($address)){
            return back() ;
        }

        $id = auth()->user()->id;
        $locale_name = $locale . '_name';
        $admin_data = User::with('cities')->findOrFail($id);
//        print_r($admin_data->cities->id);
//        return;

        $all_states = array();
        $states = array();
        $selected_user_country_id = 0;
        $regions = [] ;

        if (!empty($admin_data->cities) > 0) {
            $selected_user_country_id = $admin_data->cities->country_id;

            $all_states = Cities::where('country_id', '=', $selected_user_country_id)
                ->get();

            foreach ($all_states as $state) {
                $states[$state->id] = $state->$locale_name;
            }

            $all_regions = Region::where("city_id", "=" , $admin_data->cities->id)->get() ;


            foreach ($all_regions as $region){
                $regions[$region->id] = $region->$locale_name ;
            }
        }


        $data = [
            'title' => trans('cpanel.site_name'),
            'admin_data' => $admin_data,

            'user_country_id' => $selected_user_country_id,
            'states' => $states,
            "regions" => $regions,
            'locale' => $locale,
            "address"=>$address,

        ];
        return view(FE . '.addresses_form')->with($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($local, Request $request, $id) {

        if ($local == "") {
            $local = session('sess_locale');
        } else {
            App::setLocale($local);
            $local = App::getLocale();
        }

        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'floor_number' => 'required',
            'unit_number' => 'required',
            'region' => 'required',


        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'name' => 'name',
            'phone' => 'phone',
            'address' => 'address',
            'floor_number' => 'floor_number',
            'unit_number' => 'unit_number',
            'region' => 'region_id',

        ]);
        if ($validator->fails()) {
            session()->flash('error_msg', 'form error');
            //  return $request->all();
            return back()->withInput()->withErrors($validator);
        } else {

            $add = Address::find($id);
            $add->name =$request->input('name');
            $add->address = $request->input('address');
            $add->phone = $request->input('phone');
            $add->floor_number = $request->input('floor_number');
            $add->unit_number = $request->input('unit_number');
            $add->region_id = $request->input('region');

            $add->save();

            session()->flash('success_msg', 'Address Created Success');
            Session::flash('alert-class', 'alert-success');
            return redirect($local.'/payment');
        }    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($local, $id) {
        $address = Address::find($id) ;

        if(empty($address)){
            return response()->json(['status'=>false, "message"=> "item not found"]) ;
        } else {
            $address->delete();

            return response()->json(["status"=>true, "message" => "item deleted"]) ;
        }
    }



}

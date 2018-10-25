<?php

namespace App\Http\Controllers\Api;

use App\Countries; //Region
use App\Cities;
use App\Region;
use App\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\User;
use Response;
use File;
class CountriesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_countries($lang = 'ar') {


        $all_countries = Countries::join('cities', 'countries.id', '=', 'cities.country_id')->
                join('regions', 'cities.id', '=', 'regions.city_id')->
                where('countries.active', 1)->
                select('countries.id as id', 'countries.' . $lang . '_name as name')->distinct()->
                get();

        return response()->json(['msg' => 'success', 'status' => true, 'result' => $all_countries], 200);
    }

    public function get_cities($lang = 'ar') {
     
        $all_cities = Cities::select('cities.id as id', 'cities.' . $lang . '_name as name')
                ->get();

        return response()->json([$all_cities], 200);
  
    }

    public function getRegions($lang = 'ar', Request $request) {
        $city_id = $request->input('CityID');
        //  if(!empty($category_id)){
        $all_regions = Region::where('city_id', $city_id)->
                select('regions.id as id', 'regions.' . $lang . '_name as name')
                ->get();

        return response()->json(['msg' => 'success', 'status' => true, 'result' => $all_regions], 200);
    }

    //getShippingAddresses

    public function getShippingAddresses($lang = 'ar', Request $request) {
        $user_id = $request->input('UserID');
        $ShippingAddresses = Address::
                join('regions', 'addresses.region_id', '=', 'regions.id')->
                join('cities', 'cities.id', '=', 'regions.city_id')->
                join('countries', 'countries.id', '=', 'cities.country_id')->
                select('regions.shipping_cost', 'addresses.unit_number', 'addresses.floor_number', 'addresses.address', 'addresses.phone', 'addresses.id', 'name', 'regions.' . $lang . '_name as region', 'cities.' . $lang . '_name as city', 'countries.' . $lang . '_name as country')->
                where('addresses.user_id', $user_id)
                ->get();

        return response()->json(['msg' => 'success', 'status' => true, 'result' => $ShippingAddresses], 200);
    }

    public function addShippingAddress($lang = 'ar') {

        if (!empty(request('UserID')) && !empty(request('UserRegion')) && !empty(request('name')) && !empty(request('phone'))) {
            $add = new Address();
            $add->user_id = request('UserID');
            $add->region_id = request('UserRegion');
            $add->name = request('name');
            $add->address = request('address');
            $add->phone = request('phone');
            $add->floor_number = (request('floor_number')) ? request('floor_number') : 0;
            $add->unit_number = (request('unit_number')) ? request('unit_number') : 0;
            $add->id = hexdec(uniqid());
            $add->save();
            return response()->json(['message' => 'Successfully', 'status' => true], 200);
        } else {
            return response()->json(['message' => 'required data', 'status' => FALSE], 200);
        }
    }

    public function deleteShippingAddress($lang = 'ar') {
        if (!empty(request('UserID')) && !empty(request('ShippingAddressID'))) {
            Address::destroy(request('ShippingAddressID'));
            $user_id = request('UserID');
            $ShippingAddresses = Address::
                    join('regions', 'addresses.region_id', '=', 'regions.id')->
                    join('cities', 'cities.id', '=', 'regions.city_id')->
                    join('countries', 'countries.id', '=', 'cities.country_id')->
                    select('regions.shipping_cost', 'addresses.unit_number', 'addresses.floor_number', 'addresses.address', 'addresses.phone', 'addresses.id', 'name', 'regions.' . $lang . '_name as region', 'cities.' . $lang . '_name as city', 'countries.' . $lang . '_name as country')->
                    where('addresses.user_id', $user_id)
                    ->get();

            return response()->json(['message' => 'success', 'status' => true, 'result' => $ShippingAddresses], 200);
        } else {
            return response()->json(['message' => 'required data', 'status' => FALSE], 200);
        }
    }

    public function updateShippingAddress($lang = 'ar') {
        if (!empty(request('UserID')) && !empty(request('ShippingAddressID'))) {

            $cartdata = Address::findOrFail(request('ShippingAddressID'));
            $cartdata->user_id = request('UserID');
            $cartdata->region_id = request('UserRegion');
            $cartdata->name = request('name');
            $cartdata->address = request('address');
            $cartdata->phone = request('phone');
            $cartdata->floor_number = request('floor_number');
            $cartdata->unit_number = request('unit_number');

            $cartdata->save();
            return response()->json(['message' => 'Successfully', 'status' => true, 'result' => $cartdata], 200);
        } else {
            return response()->json(['message' => 'required data', 'status' => FALSE], 200);
        }
    }

    public function updateProfile($lang = 'ar', Request $request) {
        if ( !empty(request('Name')) && !empty(request('id'))) {

          //  dd($request->file('Image'));
            
            $user = User::findOrFail(request('id'));

            if(!empty($request->file('Image'))){
                 $image=$request->file('Image');   
   
            $date_path='/uploads/user_img/'.date("Y").'/'.date("m").'/'.date("d").'/';
              $path = public_path().$date_path;

               if(!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
   
              }
               $file_name = date('YmdHis') . mt_rand() . '_user_img.' .$image->getClientOriginalExtension();
//        
//
            if ($image->move($path, $file_name))
                  {
             $img = 'public'.$date_path.$file_name;

               $user->image= $img;
         

             }
            }
            $user->name = request('Name');


      
            $user->phone = request('Phone');
            $user->phone = request('Address');
            $user->floor_number = request('FloorNumber');
            $user->unit_number = request('UnitNumber');
            $user->cities_id = request('City');
            $user->region_id = request('Region');
            $user->save();


            return response()->json(['message' => 'Successfully', 'status' => true, 'result' => $user], 200);
        } else {
            return response()->json(['message' => 'required data', 'status' => FALSE], 200);
        }
    }
    public function getOrders($lang = 'ar'){
        
        $user_id=request('UserID');
              if (!empty($user_id)) {
  
            $all_orders = DB::table('orders')->
                    select('id', 'order_number', 'order_date', 'order_price')->
                   where(['user_id' => $user_id])
                    ->get();

            return response()->json(['message' => 'Successfully', 'status' => true, 'result' => $all_orders], 200);
        } else {
            return response()->json(['message' => 'required data', 'status' => FALSE], 200);
        }
        
    }
    public function getOrderDetails(){
             $order_id=request('OrderID');
              if (!empty($order_id)) {
  
            $order_details = DB::table('orders')->
                    select('id', 'order_number', 'order_date', 'order_price', 'address', 'floor_number', 'unit_number', 'city', 'region')->
                   where(['id' => $order_id])
                    ->first();
            $order_details->items=DB::table('order_details')->
                    select('id', 'title', 'image', 'price', 'price', 'count','item_id')->
                   where(['order_id' => $order_id])
                    ->get();

            return response()->json(['message' => 'Successfully', 'status' => true, 'result' => $order_details], 200);
        } else {
            return response()->json(['message' => 'required data', 'status' => FALSE], 200);
        }  
    }

}

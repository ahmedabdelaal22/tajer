<?php

namespace App\Http\Controllers\Administrator;

use App\Orders;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Categories;
use App\Brands;
use App\Item_images;
use App\Items_sizes;
use App\Cities;
use App\Countries;
use App\Orders_details;
use Validator;
use Auth;
use App;
use DB;
use File;
use Carbon\Carbon;

class ReportsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customers(Request $request) {

        $all_country_data = Countries::all();

        $all_country[0] = 'Select Country';
        foreach ($all_country_data as $row_country) {
            $all_country[$row_country->id] = $row_country->ar_name;
        }

        $from_order_date = trim($request->input('from_order_date'));
        $to_order_date = trim($request->input('to_order_date'));
        $country_id = trim($request->input('country_id'));
        $city_id = trim($request->input('city_id'));

        $all_users_query = User::with('city.country');

        $all_city = array();
        if ($country_id > 0) {
            $all_city = array(0 => 'select city');
            $all_city_data = Cities::where('country_id', '=', $country_id)->get();
            foreach ($all_city_data as $row_city) {
                $all_city[$row_city->id] = $row_city->ar_name;
            }
        }

        if ($city_id > 0) {
            $all_users_query = $all_users_query->where('city_id', '=', $city_id);
        }

        if ($from_order_date > 0 && $to_order_date > 0) {
            $all_users_query = $all_users_query->whereHas('user_orders', function($q) use ($from_order_date, $to_order_date) {
                $q->whereBetween('created_at', [$from_order_date, $to_order_date]);
            });
        } else {
            if ($from_order_date > 0) {

                $all_users_query = $all_users_query->whereHas('user_orders', function($q) use ($from_order_date) {
                    $q->where('created_at', '>=', $from_order_date);
                });
            }
            if ($to_order_date > 0) {

                $all_users_query = $all_users_query->whereHas('user_orders', function($q) use ($to_order_date) {
                    $q->where('created_at', '<=', $to_order_date);
                });
            }
        }

        $all_users = $all_users_query->get();
        //print_r($all_users);
        /*    foreach ($all_users as $row) {
          print_r($row->user_orders->count()) . '<br/>';
          }
         */
//        return;


        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'all_users' => $all_users,
            'all_country' => $all_country,
            'all_city' => $all_city,
            'city_id' => $city_id,
        ];

        return view(AD . '.reports.customers')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function brands(Request $request) {

        $all_brands_data = Brands::all();
        $all_brands[0] = 'Select brand';
        foreach ($all_brands_data as $row_brand) {
            $all_brands[$row_brand->id] = $row_brand->title;
        }

        $from_order_date = trim($request->input('from_order_date'));
        $to_order_date = trim($request->input('to_order_date'));
        $brand_id = trim($request->input('brand_id'));

//        $all_users_query = Orders_details::with('brand');
        $all_users_query = Brands::where('active', '=', 1);

        $all_city = array();

        if ($brand_id > 0) {
            $all_users_query = $all_users_query->where('id', '=', $brand_id);
        }

        if ($from_order_date > 0 && $to_order_date > 0) {
            $all_users_query = $all_users_query->whereBetween('created_at', [$from_order_date, $to_order_date]);
        } else {
            if ($from_order_date > 0) {

                $all_users_query->where('created_at', '>=', $from_order_date);
            }
            if ($to_order_date > 0) {
                $all_users_query->where('created_at', '<=', $to_order_date);
            }
        }

        $all_users = $all_users_query->get();
        /*  print_r($all_users);
          foreach ($all_users as $row) {
          print_r($row->orders_details) . '<br/>';
          }

          return;
         */

        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'all_users' => $all_users,
            'all_brands' => $all_brands,
            'brand_id' => $brand_id,
        ];

        return view(AD . '.reports.brands')->with($data);
    }

    public function orders(Request $request) {

        $from_order_date = trim($request->input('from_order_date'));
        $to_order_date = trim($request->input('to_order_date'));
        $country_id = trim($request->input('country_id'));
        $city_id = trim($request->input('city_id'));
        $payment_method_id = trim($request->input('payment_method_id'));



        $all_country_data = Countries::all();
        $all_country[0] = 'Select Country';
        foreach ($all_country_data as $row_country) {
            $all_country[$row_country->id] = $row_country->ar_name;
        }

        $all_city = array();
        if ($country_id > 0) {
            $all_city = array(0 => 'select city');
            $all_city_data = Cities::where('country_id', '=', $country_id)->get();
            foreach ($all_city_data as $row_city) {
                $all_city[$row_city->id] = $row_city->ar_name;
            }
        }

        $payment_methods[0] = 'Select payment method';
        $payment_methods = array_merge($payment_methods, User::GetPaymentMethods());




        $all_users_query = Orders::with('city.country');

        if ($city_id > 0) {
            $all_users_query = $all_users_query->where('city_id', '=', $city_id);
        }
        if ($payment_method_id > 0) {
            $all_users_query = $all_users_query->where('payment_method', '=', $payment_method_id);
        }

        if ($from_order_date > 0 && $to_order_date > 0) {
            $all_users_query = $all_users_query->whereBetween('created_at', [$from_order_date, $to_order_date]);
        } else {
            if ($from_order_date > 0) {

                $all_users_query->where('created_at', '>=', $from_order_date);
            }
            if ($to_order_date > 0) {
                $all_users_query->where('created_at', '<=', $to_order_date);
            }
        }

        $all_users = $all_users_query->get();
//        print_r($all_users);
        /*    foreach ($all_users as $row) {
          print_r($row->user_orders->count()) . '<br/>';
          }
         */
//        return;


        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'all_users' => $all_users,
            'all_country' => $all_country,
            'all_city' => $all_city,
            'city_id' => $city_id,
            'payment_methods' => $payment_methods,
            'payment_method_id' => $payment_method_id,
        ];

        return view(AD . '.reports.orders')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}

<?php

namespace App\Http\Controllers\Administrator;

use App\Orders;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Categories;
use App\Brands;
use App\Item_images;
use App\Items_sizes;
use App\Cities;
use Validator;
use Auth;
use App;
use DB;
use File;
use Carbon\Carbon;

class OrdersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        if (!auth()->user()) {
            return redirect('admin/admin-login');
        }

        $all_orders = Orders::all();

        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'all_data' => $all_orders,
        ];

        return view(AD . '.orders')->with($data);
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
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders, $id) {

        //  $order_details = Orders::findOrFail($id);
        $order_details = Orders::with('user', 'city.country')->findOrFail($id);

//        print_r($order_details->city->country);
//        foreach ($order_details->order_details as $row_city_order) {
//            print_r($row_city_order) . '<br/>';
//        }
//        return;
        $data = [
            'title' => 'site_name',
            'page_title' => 'add_admin',
            'form_title' => 'admin_form',
            'submit_button' => 'save',
            'admin_data' => $order_details,
            'type' => 'edit',
        ];
        return view(AD . '.order_details')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders) {
        return $orders;
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orders $orders) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders) {
        //
    }

}

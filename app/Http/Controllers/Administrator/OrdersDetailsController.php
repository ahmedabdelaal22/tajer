<?php

namespace App\Http\Controllers\Administrator;

use App\Orders_details;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Categories;
use App\Brands;
use App\Item_images;
use App\Items_sizes;
use Validator;
use Auth;
use App;
use DB;
use File;
use Carbon\Carbon;

class OrdersDetailsController extends Controller {

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
     * @param  \App\Orders_details  $orders_details
     * @return \Illuminate\Http\Response
     */
    public function show(Orders_details $orders_details) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orders_details  $orders_details
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders_details $orders_details) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orders_details  $orders_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orders_details $orders_details) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orders_details  $orders_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders_details $orders_details) {
        //
    }

}

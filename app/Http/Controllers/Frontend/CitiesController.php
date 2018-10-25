<?php

namespace App\Http\Controllers\Frontend;

use App\Cities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use App\User;
use App;
use DB;
use Response;
use File;
use Validator;
use Carbon\Carbon;

class CitiesController extends Controller {

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
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function show(Cities $cities) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function edit(Cities $cities) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cities $cities) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cities $cities) {
        //
    }

    function cities_country(Request $request) {
//        if ($locale == "") {
//            $locale = session('sess_locale');
//        } else {
//            App::setLocale($locale);
//        }
        $locale = App::getLocale();

        $cities = array(Array
                (
                'name' => trans('cpanel.select_city'),
                'id' => ''
        ));
        $country_id = $request->input('country_id');
        $cities_data = array();
        $cities_data = Cities::where('country_id', '=', $country_id)->select($locale . '_name as name', 'id')->get()->toArray();
//        print_r($cities);
//        print_r($cities_data);
//        print_r(array_merge($cities, $cities_data));
        $data = [
            'cities_data' => array_merge($cities, $cities_data),
        ];

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

    public function regions_city(Request $request) {

        $locale = App::getLocale();

        $cities = array(Array
        (
            'name' => trans('cpanel.select_region'),
            'id' => ''
        ));
        $city_id = $request->input('city_id');
        $cities_data = array();
        $cities_data = App\Region::where('city_id', '=', $city_id)->select($locale . '_name as name', 'id')->get()->toArray();

        $data = [
            'cities_data' => array_merge($cities, $cities_data),
        ];

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

}

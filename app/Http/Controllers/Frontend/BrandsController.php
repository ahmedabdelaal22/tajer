<?php

namespace App\Http\Controllers\Frontend;

use App\Brands;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Items;
use App\User;
use Validator;
use Auth;
use App;
use DB;
use File;
use Session;
use Carbon\Carbon;

class BrandsController extends Controller {

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
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlist $wishlist) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlist) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist) {
        //
    }



    public function get_brands($locale = "", Request $request) {
//        return $request->all();
        $per_page = 16;
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }

 
        $Brands = Brands::paginate($per_page);
                

        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'body_class' => 'page  page-template-default full',
            'Brands' => $Brands,
        ];


        if ($request->ajax()) {

            $view = view(FE . '.brands_load_more', compact('data'))->render();
            // return $view;
            return response()->json(['html' => $view]);
        }
        return view(FE . '.get_brands', compact(array('Brands', 'title' => 'site_name', 'page_title' => 'admins')));
//        return view(FE . '.get_wishlist')->with($data);
    }



}

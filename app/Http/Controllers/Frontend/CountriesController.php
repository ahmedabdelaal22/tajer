<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Validator;
use App\Countries;
use App\Cities;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;

class CountriesController extends Controller {

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
     * @param  \App\Cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function show(Cases $cases) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function edit(Cases $cases) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cases $cases) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cases $cases) {
        //
    }

}

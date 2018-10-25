<?php

namespace App\Http\Controllers\Frontend;

use App\Reviews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Validator;
use Auth;
use App;
use DB;
use File;
use Carbon\Carbon;

class ReviewsController extends Controller {

    /**
     * 
     */
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
    public function store_review(Request $request, $locale = "") {

        $rules = [
            'comment' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'comment' => 'comment',
        ]);
        if ($validator->fails()) {
            session()->flash('error_msg', 'form error');
            $data = [
                'msg' => 'success',
            ];

            return response($data, 200)->header('Content-Type', 'text/plain');
            return back()->withInput()->withErrors($validator);
        } else {
   if($request->input('rate')){
                 $id = hexdec(uniqid());
            $user_id = auth()->user()->id;

            $add = new Reviews;
            $add->id = $id;
            $add->user_id = $user_id;
            $add->items_id = $request->input('items_id');
         
            $add->rate = $request->input('rate');
            $add->comment = $request->input('comment');
            $add->save();

            $data = [
                'msg' => 'success',
            ];

            return response($data, 200)->header('Content-Type', 'text/plain'); 
            }else{

            $id = hexdec(uniqid());
            $user_id = auth()->user()->id;

            $add = new Reviews;
            $add->id = $id;
            $add->user_id = $user_id;
            $add->items_id = $request->input('items_id');
         
            $add->rate = 0;
            $add->comment = $request->input('comment');
            $add->save();

            $data = [
                'msg' => 'success',
            ];

            return response($data, 200)->header('Content-Type', 'text/plain'); 
            }
        
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function show(Reviews $reviews) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function edit(Reviews $reviews) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reviews $reviews) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reviews $reviews) {
        //
    }

}

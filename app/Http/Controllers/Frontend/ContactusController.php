<?php

namespace App\Http\Controllers\Frontend;

use App\Contactus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use App\User;
use App;
use DB;
use Response;
use File;
use Session;
use Validator;


class ContactusController extends Controller {


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
    public function create($locale) {
                if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }

    
        $data = [

            'locale' => $locale,

        ];
        return view(FE . '.v_contact_us')->with($data);
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
            'email' => 'required',
            'subject' => 'required',
             'message' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'name' => trans('cpanel.name'),
            'phone' => trans('cpanel.phone'),
            'email' => trans('cpanel.email'),
            'subject' => trans('cpanel.subject'),
             'message' => trans('cpanel.message'),
      
        ]);
        if ($validator->fails()) {
            session()->flash('error_msg', 'form error');
            //  return $request->all();
            return back()->withInput()->withErrors($validator);
        } else {
             $id = hexdec(uniqid());
             $add = new Contactus;
             $add->id =  $id;
             $add->name     = $request->input('name');
             $add->email    = $request->input('email');
             $add->phone    = $request->input('phone');
             $add->subject  = $request->input('subject');
             $add->message  = $request->input('message');
             $add->active   = 1;
             $add->save();

//return $request->all();return;
            session()->flash('success_msg', 'You contact us successfully');
             Session::flash('alert-class', 'alert-success');
            return redirect($locale.'/contact-us');
        }
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
    public function update(Request $request) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function destroy() {
        //
    }

    public function About_us($locale) {
        
                if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }

    
        $data = [

            'locale' => $locale,

        ];
        return view(FE . '.v_about_us')->with($data);
    }

}

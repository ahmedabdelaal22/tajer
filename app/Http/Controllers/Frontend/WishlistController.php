<?php

namespace App\Http\Controllers\Frontend;

use App\Wishlist;
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

class WishlistController extends Controller {

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

    public function wishlist(Request $request, $locale = "") {

        App::setLocale($locale);
        $locale = App::getLocale();
        //check if admin login
        if (!auth()->user()) {
            return redirect('/' . $locale);
        }
        if ($request->input('items_id')) {
            $addmemberid = auth()->user()->id;
            $addproductid = $request->input('items_id');
            $wishlists = DB::table('wishlists')
                    ->where('wishlists.user_id', '=', $addmemberid)
                    ->where('wishlists.items_id', '=', $addproductid)
                    ->count();
            if ($wishlists == 1) {
                $deleteAlert = DB::table('wishlists')
                        ->where('wishlists.user_id', '=', $addmemberid)
                        ->where('wishlists.items_id', '=', $addproductid)
                        ->delete();
                $data = 'deleted';
                return response($data, 200)->header('Content-Type', 'text/plain');
                // If product has already added to wishlist then remove from Database
            } else {
                $add = new Wishlist;
                $add->id = hexdec(uniqid());
                $add->user_id = $addmemberid;
                $add->items_id = $addproductid;
                $add->save();
                $data = 'added';

                return response($data, 200)->header('Content-Type', 'text/plain');

                // If product has not in wishlist then add to Database
            }
        }
    }

    public function get_wishlist($locale = "", Request $request) {
//        return $request->all();
        $per_page = 16;

        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }
        //check if admin login
        if (!auth()->user()) {
            return redirect('/' . $locale);
        }
        $user_login = auth()->user()->id;
        $items = Items::leftJoin('wishlists', 'wishlists.items_id', '=', 'items.id')
                ->where('wishlists.user_id', $user_login)
                ->paginate($per_page);
                
        $body_class = 'page  page-template-default full';
        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'body_class' => 'page  page-template-default full',
            'items' => $items,
        ];


        if ($request->ajax()) {

            $view = view(FE . '.wishlist_load_more', compact('data'))->render();
            // return $view;
            return response()->json(['html' => $view]);
        }
        return view(FE . '.get_wishlist', compact(array('items', 'body_class', 'title' => 'site_name', 'page_title' => 'admins')));
//        return view(FE . '.get_wishlist')->with($data);
    }

    public function delete_wishlist($local = 'ar', $id) {
        $delete = Wishlist::findOrFail($id);
        $delete->delete();
        if ($delete == true) {


            Session::flash('message', trans('cpanel.Delete_success'));
            Session::flash('alert-class', 'alert-success');
            return redirect($local . '/Wishlist');
        }
    }
}

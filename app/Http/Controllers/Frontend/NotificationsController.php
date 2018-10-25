<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Notifications;
use App\Messages;

use Auth;
use DB;
use App\Bids;
use Carbon\Carbon;

class NotificationsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        Carbon::setLocale($locale);
    }

    public function index($locale = '', Request $request) {
        $user_id = auth()->user()->id;
   

        $count_notfication=Notifications::where('receiver_id',$user_id)->where('view',0)->update(array('view'=>1));
             $count_message=Messages::where('receiver_id',$user_id)->where('is_read',0)->count();

                  session(['count_notfication' => 0]);
                 session(['count_message' => $count_message]);
        $notificatins = Notifications::where('receiver_id', $user_id)->orderBy('created_at', 'DESC')->paginate(15);
        //dd($notificatins);
        foreach ($notificatins as $value) {
            $bid_id = DB::table('bids')
                            ->where('users_id', $value->sender_id)
                            ->where('items_id', $value->items_id)->first();
            if ($bid_id) {
                $value->delete = @$bid_id->id;
            }
        }

        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'notificatins' => $notificatins,
        ];

        if ($request->ajax()) {

            $view = view(DSH . '.notification_load_more', compact('data'))->render();
            return response()->json(['html' => $view]);
        }
        return view(DSH . '.notifications', compact(array('notificatins', 'title' => 'site_name', 'page_title' => 'admins')));
    }

    public function add_bids(Request $request) {
        $bids = Bids::where('users_id', $request->user_id)->where('items_id', $request->item_id)->first();

        if (count($bids) == 0) {
            $data = 'error';
            return response($data, 200)->header('Content-Type', 'text/plain');
        }
//        $id = hexdec(uniqid());
//        $add = new App\Bids();
//        $add->id = $id;
//        $add->users_id = $request->user_id;
//        $add->items_id = $request->item_id;
//        $add->price = $request->price;
//        $add->save();
        $edit = App\Items::findOrFail($request->item_id);
        $edit->bids_id = $bids->id;
        $edit->save();
        $data = 'done';

        return response($data, 200)->header('Content-Type', 'text/plain');
    }
    
    public function delte_notfication(Request $request){
        $data=Notifications::where('id', $request->id)->delete();
                return response($data, 200)->header('Content-Type', 'text/plain');

    }

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
     * @param  \App\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function show(Notifications $notifications) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function edit(Notifications $notifications) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notifications $notifications) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notifications  $notifications
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notifications $notifications) {
        //
    }

}

<?php

namespace App\Http\Controllers\Frontend;

use App\Messages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Validator;
use Auth;
use App;
use DB;
use File;
use Session;
use App\Notifications;

class MessagesController extends Controller {

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
    }

    public function index() {

        $user_login = auth()->user()->id;

        $count_notfication = Messages::where('receiver_id', $user_login)->where('is_read', 0)->update(array('is_read' => 1));
        $count_message = Notifications::where('receiver_id', $user_login)->where('view', 0)->count();

        session(['count_notfication' => $count_notfication]);
        session(['count_message' => 0]);

        $messages = DB::table('users')
                ->join('messages', 'messages.receiver_id', '=', 'users.id')
                ->join('users as sender', 'messages.sender_id', '=', 'sender.id')
                ->where('messages.receiver_id', '=', $user_login)
                ->where('messages.delete', '=', 0)
                ->select('users.*', 'messages.message', 'messages.sender_id', 'messages.id', 'sender.name as s_name', 'sender.image as s_image', 'messages.created_at as msg_date')
                ->get();

        //  echo "<pre>";
        // print_r($messages);
        // echo "</pre>";
        // return

        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'messages' => $messages,
        ];
        return view(DSH . '.v_inbox')->with($data);
    }

    public function delete_mesage($locale = "", $id) {

        $edit = Messages::findOrFail($id);

//  // $edit->id=$id;
        $edit->delete = 1;

        if ($edit->save()) {


            Session::flash('message', trans('cpanel.Delete_success'));
            Session::flash('alert-class', 'alert-success');
            return redirect($locale . '/your-inbox');
        }
    }

    public function delete_end($locale = "", $id) {
        $delete = Messages::findOrFail($id);
        $delete->delete();
        if ($delete == true) {


            Session::flash('message', trans('cpanel.Delete_success'));
            Session::flash('alert-class', 'alert-success');
            return redirect($locale . '/messages_delted');
        }
    }

    public function messages_delted() {

        $user_login = auth()->user()->id;
 $count_notfication = Messages::where('receiver_id', $user_login)->where('is_read', 0)->update(array('is_read' => 1));
        $count_message = Notifications::where('receiver_id', $user_login)->where('view', 0)->count();

        session(['count_notfication' => $count_notfication]);
        session(['count_message' => 0]);
        $messages = DB::table('users')
                ->join('messages', 'messages.receiver_id', '=', 'users.id')
                ->join('users as sender', 'messages.sender_id', '=', 'sender.id')
                ->where('messages.receiver_id', '=', $user_login)
                ->where('messages.delete', '=', 1)
                ->select('users.*', 'messages.message', 'messages.sender_id', 'messages.id', 'sender.name as s_name', 'sender.image as s_image', 'messages.created_at as msg_date')
                ->get();

        //  echo "<pre>";
        // print_r($messages);
        // echo "</pre>";
        // return

        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'messages' => $messages,
        ];
        return view(DSH . '.messages_delted')->with($data);
    }

    public function sent_messages() {

        $user_login = auth()->user()->id;
 $count_notfication = Messages::where('receiver_id', $user_login)->where('is_read', 0)->update(array('is_read' => 1));
        $count_message = Notifications::where('receiver_id', $user_login)->where('view', 0)->count();

        session(['count_notfication' => $count_notfication]);
        session(['count_message' => 0]);
        $messages = DB::table('users')
                ->join('messages', 'messages.sender_id', '=', 'users.id')
                ->join('users as receiver', 'messages.receiver_id', '=', 'receiver.id')
                ->where('messages.sender_id', '=', $user_login)
                ->where('messages.delete', '=', 0)
                ->select('users.*', 'messages.message', 'messages.sender_id', 'receiver.name as r_name', 'receiver.image as r_image', 'messages.created_at as msg_date')
                ->get();

        //  echo "<pre>";
        // print_r($messages);
        // echo "</pre>";
        // return

        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'messages' => $messages,
        ];
        return view(DSH . '.v_sent_messages')->with($data);
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
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message) {
        //
    }

}

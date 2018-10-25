<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Countries;
use App\Cities;
use App\Subscribe;
use App\Notifications;
use App\Messages;
use App\Cart as Cart1;
use \Cart as Cart;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use Validator;
use Auth;
use App;
use Hash;
use Mail;
use DB;
use File;
use Image;
use App\Sub_categories;
use App\Categories;
use App\Items;
use App\Region;

class UsersController extends Controller {

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
     * Display admin login blade
     */
    public function login() {
        $locale = session('sess_locale');
        //check if admin login
        if (auth()->user()) {
            // echo"done"; return;
            return redirect('/' . $locale);
        }
        // else{
        //        echo" not done"; return;
        // }
//        return 'ccc';
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'body_class' => 'page  page-template-default full'
        ];
        return view(FE . '.v_login')->with($data);
    }

    /**
     * Ckeck if this user already exist in database or not.
     */
    public function user_login(Request $request) {



        $locale = session('sess_locale');
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            // 'email' => 'email',
            // 'password' => 'password',
        ]);
        if ($validator->fails()) {


           
            return back()->withInput()->withErrors($validator);
        } else {

            if ($request->input('remember') == 'forever') {
                $remember = true;
            } else {
                $remember = false;
            }
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'active' => 1], $remember)) {
                $user_id = auth()->user()->id;


                foreach (Cart::content() as $row) {
                    
                    
                    $cartdata = Cart1::where('user_id', $user_id)->where('item_id', $row->id)->first();
                    if ($cartdata == null) {
                        $add = new Cart1();
                        $add->user_id = $user_id;
                        $add->item_id = $row->id;
                        $add->quantity = $row->qty;
                        $add->price = $row->price;
                        $add->color = $row->options->color;
                        $add->size = $row->options->size;
                        $add->image = $row->options->image;
                        $add->vendor_id = $row->options->vendor_id;
                        $add->name = $row->name;
                        $add->save();
                    } else {
                        $cartdata->quantity = $cartdata->quantity + $row->qty;
                        $cartdata->save();
                    }
                    
                    
                }

                $carts_tbl = DB::table('carts')->where(['user_id' => $user_id])->first();
                if (isset($carts_tbl)) {
                    $itemscart = DB::table('carts')->where(['user_id' => $user_id])->get();
                    Cart::destroy();

                    foreach ($itemscart as $row) {

                        Cart::add([
                            ['id' => $row->item_id, 'name' => $row->name, 'qty' => $row->quantity, 'price' => $row->price, 'options' => ['size' => $row->size, 'image' => $row->image, 'color' => $row->color]]
                        ]);
                    }
                }

                $count_notfication = Notifications::where('receiver_id', $user_id)->where('view', 0)->count();
                $count_message = Messages::where('receiver_id', $user_id)->where('is_read', 0)->count();

                session(['count_notfication' => $count_notfication]);
                session(['count_message' => $count_message]);

                return redirect('/' . $locale);
//                } else {
//                    $user_id = auth()->user()->id;
//                    return $this->logout();
//                }
            } else {


          
                session()->flash('error_login', trans('cpanel.error_login'));
                return redirect()->back();
            }
        }
    }

    /**
     * forgotPassword
     *
     * */
    public function forgotPassword() {
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.forgot'),
            'body_class' => 'page home page-template-default'
        ];
        return view(FE . '.forgot_password')->with($data);
    }

    public function send_new_password(Request $request) {
        $locale = session('sess_locale');
        $rules = [
            'email' => 'required|email'
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'email' => 'email',
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            $email = $request->input('email');
            if (!empty($email)) {
                $user = User::where('email', $email)->first();
                if ($user) {
                    global $randm;
                    $randm = rand(0, 123456789);

                    Mail::send('emails.reminder', ['user' => $user, 'password' => $randm], function ($m) use ($user) {
                        $m->from('info@lodex-solutions.com', 'RnRn');

                        $m->to($user->email, $user->name)->subject('New password RnRn');
                    });

                    $user->password = bcrypt($randm);
                    $user->save();
                }
            }
        }
    }

    public function sendPassword(Request $request) {
        //dd($request->all());
        $locale = session('sess_locale');
        $rules = [
            'email' => 'required|email',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'email' => trans('cpanel.email'),
        ]);
        if ($validator->fails()) {

            return back()->withInput()->withErrors($validator);
        } else {
            $email = $request->input('email');
            $user = User::where('email', '=', $email)->first();

            if (!empty($user)) {

                global $randm;
                $randm = rand(0, 123456789);

                Mail::send('emails.reminder', ['user' => $user, 'password' => $randm], function ($m) use ($user) {
                    $m->from('info@lodex-solutions.com', 'Tajer');

                    $m->to($user->email, $user->name)->subject('New password Tajer');
                });

                $user->password = bcrypt($randm);
                $user->save();
                session()->flash('send_email', trans('cpanel.please_redirect_mail_send_new_passwod'));
                return redirect()->back();
            } else {

                session()->flash('not_user', trans('cpanel.not_user'));
                return redirect()->back();
            }
        }
    }

    /**
     * Logout clear session to user.
     *
     * @return to login page
     */
    public function logout() {
        $locale = session('sess_locale');
        $user_id = auth()->user()->id;
        $cart_data = Cart::content();

        $carts_tbl = DB::table('carts')->where(['user_id' => $user_id])->first();
        if (isset($carts_tbl)) {

            Cart1::where('user_id', $user_id)->delete();



            foreach (Cart::content() as $row) {
                $cartdata = Cart1::where('user_id', $user_id)->where('item_id', $row->id)->first();
                if ($cartdata == null) {
                    $add = new Cart1();
                    $add->user_id = $user_id;
                    $add->item_id = $row->id;
                    $add->quantity = $row->qty;
                    $add->price = $row->price;
                    $add->color = $row->options->color;
                    $add->size = $row->options->size;
                    $add->image = $row->options->image;
                    $add->vendor_id = $row->options->vendor_id;
                    $add->name = $row->name;
                    $add->save();
                } else {
                    $cartdata->quantity = $cartdata->quantity + $row->qty;
                    $cartdata->save();
                }
            }
        } else {



            foreach (Cart::content() as $row) {
                $cartdata = Cart1::where('user_id', $user_id)->where('item_id', $row->id)->first();
                if ($cartdata == null) {
                    $add = new Cart1();
                    $add->user_id = $user_id;
                    $add->item_id = $row->id;
                    $add->quantity = $row->qty;
                    $add->price = $row->price;
                    $add->color = $row->options->color;
                    $add->size = $row->options->size;
                    $add->image = $row->options->image;
                    $add->vendor_id = $row->options->vendor_id;
                    $add->name = $row->name;
                    $add->save();
                } else {
                    $cartdata->quantity = $cartdata->quantity + $row->qty;
                    $cartdata->save();
                }
            }
        }

        Auth::logout();
        Session()->flush();
        return redirect('/' . $locale);
    }

    /**
     * Display Home.
     *
     * @return \Illuminate\Http\Response
     */
    public function home($locale = 'ar') {
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.home'),
            'body_class' => 'page home page-template-default'
        ];
        return view(AD . '.index')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $locale = session('sess_locale');
        if (!auth()->user()) {
            return redirect($locale . '/login');
        }
        $all_users = User::all();
        $data = [
            'title' => 'site_name',
            'page_title' => 'admins',
            'all_users' => $all_users,
            'body_class' => 'page home page-template-default'
        ];

        return view(AD . '.users')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $types = User::GetAdminTypes();
        $data = [
            'title' => 'site_name',
            'page_title' => 'add_admin',
            'type' => 'add',
            'form_title' => 'admin_form',
            'submit_button' => 'save',
            'types' => $types,
            'body_class' => 'page home page-template-default'
        ];
        return view(AD . '.users_form')->with($data);
    }

    public function subscribe_email($local = '', Request $request) {

        $id = hexdec(uniqid());
        $email = Subscribe::where('email', $request->input('email'))->get();

        if (count($email) > 0) {

            $data = 'error';

            return response($data, 200)->header('Content-Type', 'text/plain');
        } else {
            $add = new Subscribe;
            $add->id = $id;

            $add->email = $request->input('email');

            $add->save();
            $data = 'done';

            return response($data, 200)->header('Content-Type', 'text/plain');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register_view() {
      
        $locale = session('sess_locale');
        if (auth()->user()) {
   
            return redirect('/' . $locale);
        }

        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'body_class' => 'page  page-template-default full'
        ];
        return view(FE . '.v_register')->with($data);
    }

    public function store(Request $request) {
     

  
        $locale = session('sess_locale');
        $rules = [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'name' => 'required|regex:/(^([ا-ىa-zA-Z \s ا-ىa-zA-Z]+)(\d+)?$)/u',
            'phone' => 'required|min:10|numeric|regex:/(0)[0-9]{9}/|unique:users',
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'email' => trans('cpanel.email'),
            'password' => trans('cpanel.password'),
            'name' => trans('cpanel.name'),
            'phone' => trans('cpanel.phone'),
        ]);

        if ($validator->fails()) {
            session()->flash('error_msg', trans('cpanel.form_error'));

   
            return back()->withInput()->withErrors($validator);
        } else {
            //  print_r($request->all()) ;
            // return ;



            $id = hexdec(uniqid());
            $add = new User;
            $add->id = $id;
             $add->name = $request->input('name');
             $add->type = $request->input('type');
              $add->email = $request->input('email');

            $add->phone = $request->input('phone');

            $add->password = bcrypt($request->input('password'));


            $add->active = 1;
            $add->permissions = 'agent';
            $add->save();
            // Send mail
            /*  Mail::send('emails.sign_up', ['data' => $add], function ($m) use ($add) {
              $m->from('master@lodex.com', trans('cpanel.sign_up'));
              $m->to($add->email, $add->name)->subject(trans('cpanel.Welcome_in') . ' ' . trans('cpanel.site_name'));
              });

             */

                   foreach (Cart::content() as $row) {
       
                    $add = new Cart1();
                    $add->user_id = $id;
                    $add->item_id = $row->id;
                    $add->quantity = $row->qty;
                    $add->price = $row->price;
                    $add->color = $row->options->color;
                    $add->size = $row->options->size;
                    $add->image = $row->options->image;
                    $add->vendor_id = $row->options->vendor_id;
                    $add->name = $row->name;
                    $add->save();
             
            }

            Auth::loginUsingId($id);
            session()->flash('success_msg', trans('cpanel.form_success'));
            return redirect('/' . $locale);
        }
    }

    public function edit($locale = '') {

        $locale = session('sess_locale');
        if (!auth()->user()) {
            return redirect('/' . $locale);
        }
        if ($locale == "") {
            $locale = session('sess_locale');
        }


        $locale_name = $locale . '_name';

        $id = auth()->user()->id;
        $count_notfication = Notifications::where('receiver_id', $id)->where('view', 0)->count();
        $count_message = Messages::where('receiver_id', $id)->where('is_read', 0)->count();

        session(['count_notfication' => $count_notfication]);
        session(['count_message' => $count_message]);
        $admin_data = User::with('cities')->findOrFail($id);
//        print_r($admin_data->cities->id);
//        return;

        $all_states = array();
        $states = array();
        $selected_user_country_id = 0;
        $regions = [] ;

        if (!empty($admin_data->cities) > 0) {
            $selected_user_country_id = $admin_data->cities->country_id;

            $all_states = Cities::where('country_id', '=', $selected_user_country_id)
                    ->get();

            foreach ($all_states as $state) {
                $states[$state->id] = $state->$locale_name;
            }

            $all_regions = Region::where("city_id", "=" , $admin_data->cities->id)->get() ;


            foreach ($all_regions as $region){
                $regions[$region->id] = $region->$locale_name ;
            }
        }

        // $types  = User::GetAdminTypes();

        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.edit_admin'),
            'submit_button' => trans('cpanel.save'),
            'admin_data' => $admin_data,
            'type' => 'edit',
            'form_title' => trans('cpanel.admin_form'),
            'user_country_id' => $selected_user_country_id,
            'states' => $states,
            "regions" => $regions,
            'body_class' => 'page home page-template-default'
        ];


        return view(DSH . '.dashboard-settings')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $locale = session('sess_locale');
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
                // 'phone' => 'min:10',
                //  'about' => 'max:140',
        ];

        if (!empty($request->input('password')) && $request->input('password') != null) {
            $rules['password'] = 'min:8';
        }

        $validator = Validator::make($request->all(), $rules);
        $validator->SetAttributeNames([
            'name' => trans('cpanel.name'),
            'password' => trans('cpanel.password'),
            'phone' => trans('cpanel.phone'),
            'email' => trans('cpanel.email'),
            'about' => trans('cpanel.About'),
        ]);
        if ($validator->fails()) {
            session()->flash('error_msg', trans('cpanel.form_error'));
//            return $request->all();
            return back()->withInput()->withErrors($validator);
        } else {
            $edit = User::findOrFail($id);
            $edit->name = $request->input('name');
            $edit->email = $request->input('email');
            $edit->about = $request->input('about');
            $edit->cities_id = $request->input('city');
            $edit->region_id = $request->input('region');
            $edit->phone = $request->input('phone');
            $edit->facebook_profile = $request->input('facebook_profile');
            $edit->google_profile = $request->input('google_profile');
            $edit->twitter_profile = $request->input('twitter_profile');
            if (!empty($request->input('password'))) {
                $edit->password = bcrypt($request->input('password'));
            }

            if (auth()->user()->id != $edit->id) {
//                $edit->active = $request->input('active');
            }


            /* ////////////////////////////// */
            if (!empty($request->file('image'))) {
                $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';
                $path = public_path() . '/uploads/user_img/' . $date_path;

                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true);
                    //  $result = File::makeDirectory($path, 0775, true, true);
                }
                $file_name = date('YmdHis') . mt_rand() . '_user_img.' . $request->file('image')->getClientOriginalExtension();

                $img1 = Image::make($request->file('image')->getRealPath());

                $img1->resize(320, 320, function ($constraint) {
                    $constraint->aspectRatio();
                    //  $edit->image                   = $path.$file_name;
                })->save($path . '/' . $file_name);

                $img1 = $date_path . $file_name;
                $edit->image = $img1;
            } else {
                //  $img = '';
            }

//            $edit->permissions = $request->input('permissions');

            $edit->save();
            session()->flash('success_msg', trans('cpanel.form_success'));
            return redirect('/' . $locale);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $delete = User::findOrFail($id);
        $delete->delete();
        session()->flash('success_msg', trans('cpanel.form_success'));
        return back();
    }

    public function update_active(Request $request, $id) {

        $active = $request->input('active');
        if ($active == 1) {
            $user_active = 0;
        } else {
            $user_active = 1;
        }

        $edit = User::findOrFail($id);
        $edit->active = $user_active;
        $edit->save();
        return back();
    }

    /**
     * Delete Selected ids
     * */
    public function DeleteSelectedAdmins(Request $request) {
        $ids = explode(",", $request->input('select_ids'));
        User::destroy($ids);
        session()->flash('success_msg', trans('cpanel.form_success'));
        return back();
    }

    /**
     * @return view file upload blade
     */
    public function uploadFiles() {
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.site_name'),
        ];
        return view(AD . '.admins.file_upload')->with($data);
    }

    /**
     * save files
     */
    public function saveuploadFiles(Request $request) {
        $add = new Photo;
        $path = public_path() . '/uploads/photos';
        foreach ($request->file('files') as $photo) {
            $file_name = date('YmdHis') . mt_rand() . 'photos.' . $photo->getClientOriginalExtension();
            if ($photo->move($path, $file_name)) {
                $add->photo = $file_name;
                $add->save();
            }
        }
        return response()->json([
                    'success' => true
        ]);
    }

    public function get_all_tajer($locale = "") {


        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }


        $all_items_tajer = User::where('permissions', '=', 'tajer')
                ->where('active', '=', "1")
                ->select('users.*', 'active as totalItem')
                ->get();

        // $admin_data = Items::with('user', 'cities.country', 'sub_categories.categories', 'brands')->findOrFail($id);
        foreach ($all_items_tajer as $value) {

            $items_tajer_count = DB::table('items')
                    ->where('items.user_id', '=', $value->id)
                    ->count();
            //   ->get(); 

            $value->totalItem = $items_tajer_count;
        }

        // echo "<pre>";
        // print_r($all_items_tajer);
        // echo "</pre>"; return;


        $data = [
            'title' => 'site_name',
            'page_title' => 'add_admin',
            'form_title' => 'admin_form',
            'submit_button' => 'save',
            'body_class' => 'single-product full-width extended',
            //  'admin_data' => $admin_data,
            'locale' => $locale,
            'all_items_tajer' => $all_items_tajer
        ];
        return view(FE . '.v_tajers')->with($data);
    }

    public function get_all_tajer_product($locale = "", $id) {

// return $id;
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }
        $locale_name = $locale . '_name';
        $locale_title = $locale . '_title';
//    $items_query = Items::with('items_colors.colors','items_sizes')
//                             ->join('sub_categories', 'sub_categories.id', '=', 'items.sub_categories_id')
//                             ->join('categories', 'categories.id', '=', 'sub_categories.categories_id')
//                             ->join('users', 'users.id', '=', 'items.user_id')
//                                 ->where('items.user_id', $id)
//                             ->where('items.active', '1')
// ->select('items.*', 'categories.' . $locale . '_title as CategoryName', 'sub_categories.' . $locale . '_title as SubCategoryName')
//                           // ->limit(18)
//                            ->get();

        $items_query = Items::with('user', 'cities.country', 'sub_categories.categories', 'brands', 'items_colors.colors', 'items_sizes')->where('items.user_id', $id);

        
        
        if (request('filteration2') != 'not' && request('filteration2')) {
            if (request('filteration2') == 'rating') {
              $items_query->leftJoin('reviews', 'items.id', '=', 'reviews.items_id')->select('items.*', DB::raw('avg(COALESCE(reviews.rate, 0)) AS average'))
                        ->groupBy('items.id')
                        ->orderBy('average', 'desc');
            } else {
               $filteration = explode(',', request('filteration2'));
                $items_query->orderBy($filteration[0], $filteration[1]);
                
            }
        }
        $admin_data = $items_query->paginate(1);


        $latest_product = Items::orderBy('created_at', 'DESC')->where('items.active', '=', "1")->take(5)->get();
        $lang = App::getLocale();
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'body_class' => 'left-sidebar',
            'admin_data' => $admin_data,
            'locale_title' => $locale_title,
            'locale' => $locale,
            'user_id' => $id,
            'latest_product' => $latest_product,
        ];
        
            if (request()->ajax()) {


            $view = view(FE . '.v_tajer_load_product')->with($data)->render();

            return response()->json(['html' => $view]);
        }


        return view(FE . '.v_tajer_product')->with($data);
    }

}

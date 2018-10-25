<?php

namespace App\Http\Controllers\Api;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Auth;
use App;
use Hash;
use Response;
use Mail;
use File;

class UsersController extends Controller {

    use AuthenticatesUsers;
    protected $casts = ['id' => 'integer'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register($lang = 'ar',Request $request) {
    


        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'min:10|unique:users',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $status = FALSE;
            $message = $validator->messages();
            $usersend = (object) array();
        } else {
            $status = TRUE;
            $message = 'success';
            $id = hexdec(uniqid());
            $user = new User;
            $user->id = $id;
            $user->name = request('name');
            $user->email = request('email');
            $user->password = bcrypt(request('password'));
            $user->phone = request('phone');
//            $user->type = $request->input('type');
            $user->permissions = 'agent';
            $user->active = 1;
            $user->api_token = str_random(60);
            //   $user->createToken('My Token', ['place-orders'])->accessToken;
            $user->save(); //findOrFail
            $usersend = (object) array();
            $usersend->id = $id ;
            $usersend->unit_number = 0;
            $usersend->floor_number = 0;
            $usersend->country = "";
            $usersend->address = "";
            $usersend->cart_count = 0;
            $usersend->phone =$user->phone;
             $usersend->profile_image = "";
              $usersend->username = $user->name;
              $usersend->email = $user->email;

            //  $user = User::findOrFail($id);
        }

        return Response::json(array(
                    'status' => $status,
                    'message' => $message,
                    'result' => $usersend
                        ), 200);
    
    }

    public function login($lang = 'ar') {
        
        $user = (object) array();
        if (!empty(request('email')) && !empty(request('password'))) {

            if (Auth::attempt(['email' => request('email'), 'password' => request('password'), 'active' => 1], FALSE)) {
                $user_id = auth()->user()->id;
                
                //LEFT JOIN carts ON carts.user_id =users.id LEFT JOIN cities ON cities.id =users.cities_id
                // LEFT JOIN countries ON countries.id =cities.country_id 
                 $user=User::leftJoin('carts', 'carts.user_id', '=', 'users.id')
                     ->leftJoin('cities', 'cities.id', '=', 'users.cities_id')
                           ->leftJoin('countries', 'countries.id', '=', 'cities.country_id')
                        ->where('users.id', $user_id)
                          ->groupBy('users.id')
                        ->select('users.id as id','users.name as username','users.email as email','users.image as profile_image','users.phone','countries.' . $lang . '_name as country ','users.address', 'users.unit_number','users.floor_number', DB::raw('COUNT(carts.id) as cart_count'))->get();
//                $sql = 'select users.id as id,users.name as username,users.email as email,users.image as profile_image, COUNT(carts.id) as cart_count ,users.phone,countries.' . $lang . '_name as country ,users.address, users.unit_number,users.floor_number from users LEFT JOIN carts ON carts.user_id =users.id LEFT JOIN cities ON cities.id =users.cities_id LEFT JOIN countries ON countries.id =cities.country_id WHERE users.id=' . $user_id . ' GROUP BY users.id';
//                $user = DB::select($sql);
              //$user=$user->first();
                return response()->json(['message' => 'Login success', 'status' => true, 'result' => $user], 201);
            } else {
                return response()->json(['message' => 'Login Faild', 'status' => false, 'result' => $user]);
            }
        } else {
            return response()->json(['message' => 'required fild', 'status' => false, 'result' => $user]);
        }
    }
    
    
    public function getUserProfile($lang = 'ar'){
                
        $user = (object) array();
        if (!empty(request('UserID'))) {

            if (User::find(request('UserID'))) {
                $user_id = request('UserID');
                
                //LEFT JOIN carts ON carts.user_id =users.id LEFT JOIN cities ON cities.id =users.cities_id
                // LEFT JOIN countries ON countries.id =cities.country_id 
                 $user=User::leftJoin('carts', 'carts.user_id', '=', 'users.id')
                     ->leftJoin('cities', 'cities.id', '=', 'users.cities_id')
                           ->leftJoin('countries', 'countries.id', '=', 'cities.country_id')
                        ->where('users.id', $user_id)
                          ->groupBy('users.id')
                        ->select('users.id as id','users.name as username','users.email as email','users.image as profile_image','users.phone','countries.' . $lang . '_name as country ','users.address', 'users.unit_number','users.floor_number', DB::raw('COUNT(carts.id) as cart_count'))->get();
//      
                return response()->json(['message' => 'data user', 'status' => true, 'result' => $user], 201);
            } else {
                return response()->json(['message' => 'not found user', 'status' => false, 'result' => $user]);
            }
        } else {
            return response()->json(['message' => 'required fild', 'status' => false, 'result' => $user]);
        }
    }

    public function loginFacebook($lang = 'ar') {
        $user = (object) array();
        $provider = 'facebook';
        $provider_id = request('FacebookID');
        if (!empty($provider_id)) {
            $sql = 'select users.id as id,users.name as username,users.email as email,users.image as profile_image, COUNT(carts.id) as cart_count ,users.phone,countries.' . $lang . '_name as country ,users.address, users.unit_number,users.floor_number from users LEFT JOIN carts ON carts.user_id =users.id LEFT JOIN cities ON cities.id =users.cities_id LEFT JOIN countries ON countries.id =cities.country_id'
                    . ' WHERE users.provider_id=' . "'" . $provider_id . "'" . ' and users.provider=' . "'" . $provider . "'" . ' GROUP BY users.id';
            $user = DB::select($sql);
            if ($user) {
                return response()->json(['msg' => 'Login success', 'status' => true, 'result' => $user], 201);
            } else {
                return response()->json(['message' => 'Login Faild', 'status' => false, 'result' => $user]);
            }
        } else {
            return response()->json(['message' => 'required fild', 'status' => false, 'result' => $user]);
        }
    }

    
        public function loginSocial() {
        $user = (object) array();
        $provider = request('provider');
        $provider_id = request('provider_id');
        if (!empty($provider_id) && !empty($provider)) {

             $user=User::where('provider_id','=', $provider_id )->where('provider','=',$provider )->first();

            if ($user) {
                
                            $user = User::leftJoin('carts', 'carts.user_id', '=', 'users.id')
                                ->leftJoin('cities', 'cities.id', '=', 'users.cities_id')
                                ->leftJoin('countries', 'countries.id', '=', 'cities.country_id')
                                ->where('users.provider_id', $provider_id)
                                            ->where('users.provider', $provider)
                                ->groupBy('users.id')
                                ->select('users.id as id', 'users.name as username', 'users.email as email', 'users.image as profile_image', 'users.phone', 'countries.' . $lang . '_name as country ', 'users.address', 'users.unit_number', 'users.floor_number', DB::raw('COUNT(carts.id) as cart_count'))->get();
//                $sql = 'select users.id as id,users.name as username,users.email as email,users.image as profile_image, COUNT(carts.id) as cart_count ,users.phone,countries.' . $lang . '_name as country ,users.address, users.unit_number,users.floor_number from users LEFT JOIN carts ON carts.user_id =users.id LEFT JOIN cities ON cities.id =users.cities_id LEFT JOIN countries ON countries.id =cities.country_id'
//                    . ' WHERE users.provider_id=' . "'" . $provider_id . "'" . ' and users.provider=' . "'" . $provider . "'" . ' GROUP BY users.id';
//            $user = DB::select($sql);
            return response()->json(['message' => 'Login success', 'status' => true, 'result' => $user], 201);
     
            } else {
                return response()->json(['message' => 'Login Faild', 'status' => false, 'result' => $user]);
            }
        } else {
            return response()->json(['message' => 'required fild', 'status' => false, 'result' => $user]);
        }
    }
    
    
      public function registerSocial($lang='ar',Request $request) {
        $rules = [
          
            'provider' => 'required',
            'provider_id' => 'required',
            'email' => 'required|email',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $status = FALSE;
            $message = (object) $validator->messages();
            $user = (object) array();
        } else {
            $status = TRUE;
            $message = 'success';
            $user = User::where('provider_id', '=', $request->input('provider_id'))->where('provider', '=', $request->input('provider'))->first();
            if (!$user) {


                $id = hexdec(uniqid());
                $user = new User;
                $user->id = $id;
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->provider = $request->input('provider');
                $user->provider_id = $request->input('provider_id');
                $user->phone = $request->input('phone');
                $user->password = "";
//            $user->type = $request->input('type');
                $user->permissions = 'agent';
                $user->active = 1;
                $user->api_token = str_random(60);
                //   $user->createToken('My Token', ['place-orders'])->accessToken;
                $user->save(); //findOrFail
                $user = User::findOrFail($id);
            }
        }
        
                         $user=User::leftJoin('carts', 'carts.user_id', '=', 'users.id')
                     ->leftJoin('cities', 'cities.id', '=', 'users.cities_id')
                           ->leftJoin('countries', 'countries.id', '=', 'cities.country_id')
                        ->where('users.id',$user->id)
                          ->groupBy('users.id')
                        ->select('users.id as id','users.name as username','users.email as email','users.image as profile_image','users.phone','countries.' . $lang . '_name as country ','users.address', 'users.unit_number','users.floor_number', DB::raw('COUNT(carts.id) as cart_count'))->get();

        return Response::json(array(
                    'status' => $status,
                    'message' => $message,
                    'result' => $user
                        ), 200);
    }

    public function loginGoogle($lang = 'ar') {
        $user = (object) array();
        $provider = 'google';
        $provider_id = request('GoogleID');
        if (!empty($provider_id)) {
            $sql = 'select users.id as id,users.name as username,users.email as email,users.image as profile_image, COUNT(carts.id) as cart_count ,users.phone,countries.' . $lang . '_name as country ,users.address, users.unit_number,users.floor_number from users LEFT JOIN carts ON carts.user_id =users.id LEFT JOIN cities ON cities.id =users.cities_id LEFT JOIN countries ON countries.id =cities.country_id'
                    . ' WHERE users.provider_id=' . "'" . $provider_id . "'" . ' and users.provider=' . "'" . $provider . "'" . ' GROUP BY users.id';
            $user = User::select($sql);
            if ($user) {
                return response()->json(['msg' => 'Login success', 'status' => true, 'result' => $user], 201);
            } else {
                return response()->json(['message' => 'Login Faild', 'status' => false, 'result' => $user]);
            }
        } else {
            return response()->json(['message' => 'required fild', 'status' => false, 'result' => $user]);
        }
    }

    public function forgotPassword($lang = 'ar') {
        $email = request('email');
        if (!empty($email)) {
            $user = User::where('email', $email)->first();
            if ($user) {
                global $randm;
                $randm = rand(0, 123456789);
                try {
                    Mail::send('emails.reminder', ['user' => $user, 'password' => $randm], function ($m) use ($user) {
                        $m->from('info@lodex-solutions.com', 'RnRn');

                        $m->to($user->email, $user->name)->subject('New password RnRn');
                    });

                    $user->password = bcrypt($randm);
                    $user->save();
                    return response()->json(['message' => 'New password sent to your mail', 'status' => TRUE]);
                } catch (Exception $ex) {
                    return response()->json(['message' => 'please agin or email not foun mail', 'status' => false]);
                }
            } else {
                return response()->json(['message' => 'not found user', 'status' => false]);
            }
        } else {
            return response()->json(['message' => 'required email', 'status' => false]);
        }
    }

//  Developed by houida

    public function updateUserProfile(Request $request) {
        $data = [
            'user_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'cities_id' => 'required',
            'about' => 'required',
        ];

        $validator = Validator::make($request->all(), $data);
        $validator->SetAttributeNames([
            'user_id' => 'user_id',
            'name' => 'name',
            'phone' => 'phone',
            'cities_id' => 'cities_id',
            'about' => 'about',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages();


            return response()->json(['message' => 'Error Data', 'status' => false, 'Error' => $errors], 201);
        } else {




            $updateUser = DB::table('users')
                    ->where('users.id', '=', $request->user_id)
                    ->update(array('name' => $request->name, 'phone' => $request->phone, 'cities_id' => $request->cities_id, 'about' => $request->about));

            $userUpdate = DB::table('users')
                            ->where('users.id', '=', $request->user_id)
                            ->select('users.*')->first();

            if ($updateUser == null) {
                return response()->json(['message' => 'Profile Not updated', 'status' => false], 201);
            } else {

                return response()->json(['message' => 'Profile Updated success', 'status' => true, 'result' => $userUpdate], 201);
            }
        }
    }

    public function updateUserImage(Request $request) {

        $data = [
            'image' => 'required',
            'user_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $data);
        $validator->SetAttributeNames([
            'image' => 'image',
            'user_id' => 'user_id',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages();


            return response()->json(['msg' => 'Error Data', 'status' => false, 'Error' => $errors], 201);
        } else {

            $request->file('image');

            $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';
            $path = public_path() . '/uploads/user_img/' . $date_path;

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
                //  $result = File::makeDirectory($path, 0775, true, true);
                // echo "iiiii"; return;
            }
            // echo "ww"; return;
            $file_name = date('YmdHis') . mt_rand() . '_user_img.' . $request->file('image')->getClientOriginalExtension();

            if ($request->file('image')->move($path, $file_name)) {
                $img = $date_path . $file_name;



                $updateimage = DB::table('users')
                        ->where('users.id', '=', $request->user_id)
                        ->update(array('image' => $img));

                $getImage = DB::table('users')
                                ->where('users.id', '=', $request->user_id)->select('users.*')->get();







                return response()->json(['msg' => 'Image Updated success', 'status' => true, 'result' => $getImage], 201);
            }
        }
    }

    public function UpdateUserPassword(Request $request) {
        $data = [
            'user_id' => 'required',
            'newPassword' => 'required',
            'Password' => 'required',
        ];

        $validator = Validator::make($request->all(), $data);
        $validator->SetAttributeNames([
            'user_id' => 'user_id',
            'newPassword' => 'newPassword',
            'Password' => 'Password',
        ]);
        if ($validator->fails()) {
            $errors = $validator->messages();


            return response()->json(['msg' => 'Error Data', 'status' => false, 'Error' => $errors], 201);
        } else {

            $userpass = DB::table('users')
                            ->where('users.id', '=', $request->user_id)
                            ->select('users.password')->first();

            $hash = $userpass->password;
            $pas = $request->Password;

            if (password_verify($pas, $hash)) {
                $updatePassword = DB::table('users')
                        ->where('users.id', '=', $request->user_id)
                        ->update(array('password' => bcrypt($request->newPassword)));
                return response()->json(['msg' => 'Account Password Updated success', 'status' => true, 'result' => $updatePassword], 201);
            } else {
                return response()->json(['msg' => 'Account Password Not updated, Password not Match', 'status' => false, 'result' => 0], 201);
            }
        }
    }

}

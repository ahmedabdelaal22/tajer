<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Socialite;
use App\User;
use App;
use DB;
use Session;

class SocialAuthController extends Controller {
    // Some methods which were generated with the app

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($locale = '', $provider) {
        if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider) {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);

        // Auth::login($authUser, true);
        if ($authUser->id > 0) {
            $user_id = $authUser->id;
            session(['user_id' => $user_id]);
        }
        $user_id = session('user_id');
        Auth::loginUsingId($user_id);

        $user_obj = DB::table('users')
                        ->where('id', '=', $user_id)->first();
        session(['user_obj' => $user_obj]);

        $sess_locale = session('sess_locale');

        return redirect($sess_locale . '/dashboard/settings/');


//      Auth::login($authUser, true);
//      return redirect($this->redirectTo);
    }
    public function Policy(){
        
    }
        public function terms(){
        
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    /*   public function findOrCreateUser($user, $provider)
      {
      $authUser = User::where('provider_id', $user->id)->first();
      if ($authUser) {
      return $authUser;
      }
      return User::create([
      'name'     => $user->name,
      'email'    => $user->email,
      'provider' => $provider,
      'provider_id' => $user->id
      ]);
      } */




    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    /*  public function redirect()
      {
      return Socialite::driver('facebook')->redirect();
      }
     */

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    /*
      public function callback()
      {

      } */



    protected $redirectPath = '/ar';

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    /*  public function handleProviderCallback() {

      try {
      $user = Socialite::driver('facebook')->user();
      } catch (Exception $e) {

      //            return redirect('ar/auth/facebook');
      }

      $authUser = $this->findOrCreateUser($user);

      // Auth::login($authUser, true);
      if ($authUser->id > 0) {
      $user_id = $authUser->id;
      session(['user_id' => $user_id]);
      }
      $user_id = session('user_id');
      Auth::loginUsingId($user_id);

      $user_obj = DB::table('users')
      ->where('id', '=', $user_id)->first();
      session(['user_obj' => $user_obj]);

      $sess_locale = session('sess_locale');

      return redirect($sess_locale . '/dashboard/settings/');
      }

      /**
     * Return user if exists; create and return if doesn't
     *
     * @param $facebookUser
     * @return User
     */
    private function findOrCreateUser($social_User, $provider) {

        $authUser = User::where('provider_id', $social_User->id)->where('provider',$provider)->first();

        if ($authUser) {
            return $authUser;
        }

        $user_id = hexdec(uniqid());
        session(['user_id' => $user_id]);


        $add = new User;
        $add->id = $user_id;
        $add->name = $social_User->name;
        $add->email = $social_User->email;
        $add->provider = $provider;
        $add->provider_id = $social_User->id;
        $add->active = 1;
        $add->permissions = 'agent';
        $add->save();

        return $add;

        /*
          return User::create([
          'id'   =>$user_id,
          'name' => $facebookUser->name,
          'email' => $facebookUser->email,
          'facebook_id' => $facebookUser->id,
          'status'=>1,
          'permissions'=>'lawyer'
          ]); */
    }

}

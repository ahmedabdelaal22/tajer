<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Coupon;
use App\Address;
use App\User;
use App\Region;
use App\Orders;
use App\OrdersDetails;
use Session;
use Carbon\Carbon;
use \Cart as Cart;
use App\Cart as Cart1;
use App;

class ShoppingController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
//        Cart::destroy();
//       Cart::add([
// ['id' => '1616928631', 'name' => 'شنط حريمي جلد باشكال والوان مختلفة', 'qty' => 4, 'price' => 10.00, 'options' => ['size' => 'large','image'=>'/public/uploads/items/2018/03/19/201803191555192085524101_items.jpeg']]
//]);
//return Cart::content();
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'body_class' => 'left-sidebar',
        ];
        return view(FE . '.cart')->with($data);
    }

    public function payment() {



        $address = Address::where('user_id', auth()->user()->id)->get();

        $user = User::find(auth()->user()->id);
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'body_class' => 'left-sidebar',
            'address' => $address,
            'user' => $user,
        ];
        return view(FE . '.payment')->with($data);
    }

    public function payment2($lacal, $region_id, $address_id) {


        $region = Region::find($region_id);


        $user = User::find(auth()->user()->id);
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'body_class' => 'left-sidebar',
            'region_id' => $region_id,
            'address_id' => $address_id,
            'user' => $user,
            'region' => $region,
        ];
        return view(FE . '.payment2')->with($data);
    }

    public function payment3($lacal, $region_id, $payment, $address_id) {


        $region = Region::find($region_id);
        $subtotal = Cart::subtotal();
        $shipping_cost = $region->shipping_cost;
        $total = (float)remove_non_numerics(Cart::subtotal()) + $region->shipping_cost;
      $count_cart= count(Cart::content());
        $user = User::find(auth()->user()->id);
    $cart = Cart1::where('user_id', auth()->user()->id)->get();
    if($cart){

      
        $id = hexdec(uniqid());
        $ordernumber = hexdec(uniqid());
        $add = new Orders();
        $add->user_id = auth()->user()->id;
        $add->id = $id;
        $add->order_number = $ordernumber;
        $add->subtotal_price =(float) remove_non_numerics(Cart::subtotal());
        $add->shipping_cost = $region->shipping_cost;
        $add->total_price = (float) remove_non_numerics(Cart::subtotal()) + $region->shipping_cost;
        $add->payment = $payment;
        $add->address_id = $address_id;
        $add->region_id = $region_id;
        $add->city_id = $region->city_id;
        $add->save();

    

        foreach ($cart as $row) {
            $adddetails = new OrdersDetails();
             $adddetails->id = hexdec(uniqid());
            $adddetails->item_id = $row->item_id;
            $adddetails->title =  $row->name;
            $adddetails->image =  $row->image;
            $adddetails->price =  $row->price;
            $adddetails->count =  $row->quantity;
            $adddetails->color =  $row->color;
            $adddetails->vendor_id =  $row->vendor_id;
            $adddetails->size =  $row->size;
             $adddetails->order_id = $id;

            $adddetails->save();
        }

       Cart1::where('user_id', auth()->user()->id)->delete();
       Cart::destroy();
    }
        $data = [
            'title' => trans('cpanel.site_name'),
            'page_title' => trans('cpanel.login'),
            'submit_button' => trans('cpanel.login'),
            'body_class' => 'left-sidebar',
            'region_id' => $region_id,
            'region_id' => $region_id,
            'user' => $user,
            'subtotal'=>$subtotal,
            'total'=>$total,
            'shipping_cost'=>$shipping_cost,
            'count_cart'=>$count_cart,
            'region' => $region,
        ];
        return view(FE . '.payment3')->with($data);
    }
    
    
    public function myorders($locale){
        
       
                if ($locale == "") {
            $locale = session('sess_locale');
        } else {
            App::setLocale($locale);
            $locale = App::getLocale();
        }
        if (!auth()->user()) {
            return redirect($locale.'/login');
        }
           $user_id = auth()->user()->id;
           $orders = Orders::where('user_id', $user_id)
                     ->orderBy('orders.created_at', 'desc')->select('orders.*','orders.id as date')
                     ->get();


                     foreach ($orders as $value) {
                       $value->date = date('Y/m/d', strtotime($value->created_at));
                     }
           
             $data = [
            'title' => trans('cpanel.site_name'),
 
            'orders' => $orders,
            'locale' => $locale,
          
        ];
        return view(FE . '.myorders')->with($data);
    }

    public function add_to_cart() {


        Cart::add([
            ['id' => request('item_id'), 'name' => request('name'), 'qty' => (request('qty')) ? request('qty') : 1, 'tax' => 0, 'price' => request('price'), 'options' => ['size' => request('size'), 'image' => request('image'), 'color' => request('color'), 'vendor_id' => request('vendor_id')]]
        ]);
        $data = 'done';

        
        if (auth()->user()) {

            $user_id = auth()->user()->id;

            $cartdata = Cart1::where('user_id', $user_id)->where('item_id', request('item_id'))->first();
            $id = request('item_id');
            $row = Cart::search(function ($cart, $key) use($id) {
                        return $cart->id == $id;
                    })->first();

              
            if ($cartdata == null) {

                $add = new Cart1();
                $add->user_id = $user_id;
                $add->item_id = $row->id;
                $add->quantity = $row->qty;
                $add->price = $row->price;
                $add->color = $row->options->color;
                $add->size = $row->options->size;
                $add->image = $row->options->image;
                $add->name = $row->name;
                $add->vendor_id = $row->options->vendor_id;
                $add->save();
            } else {
                $cartdata->quantity = $cartdata->quantity + request('qty');
                $cartdata->save();
            }
        }



        return response()->json($data);
    }

    public function add_to_cart_array() {
        $data = request('items');
        $items = explode(',', $data);
        for ($i = 0; $i < count($items); $i++) {
            $row = \App\Items::findOrFail($items[$i]);
            Cart::add([
                ['id' => $row->id, 'name' => $row->title, 'qty' => 1, 'tax' => 0, 'price' => $row->discount_price, 'options' => ['image' => $row->thumbnail_image]]
            ]);
        }
        $data = 'done';
        $view = view(FE . '.more')->render();

        return response()->json(['html' => $view]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_couben() {

        $dt = Carbon::now();

        $value = request('coupon_code');

        $copens = Coupon::where('value', $value)
                ->where('start_date', '<=', $dt)->
                where('end_date', '>=', $dt)
                ->first();


        if ($copens) {
            $real_integer = $this->remove_non_numerics(Cart::subtotal());

            $end = ($real_integer * $copens->ratio) / 100;


            session()->put('coupon', [
                'name' => $copens->value,
                'discount' => $copens->ratio
            ]);

            $data = $real_integer - $end;
        } else {
            $data = 'error';
        }

        return response($data, 200)->header('Content-Type', 'text/plain');
    }

    function remove_non_numerics($str) {
        $str = explode('.', $str);
        $temp = trim($str[0]);

        $result = "";
        $pattern = '/[^0-9]*/';
        $result = preg_replace($pattern, '', $temp);

        return $result.'.'.@$str[1];
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
     * @param  \App\Bids  $bids
     * @return \Illuminate\Http\Response
     */
    public function show(Bids $bids) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bids  $bids
     * @return \Illuminate\Http\Response
     */
    public function edit(Bids $bids) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bids  $bids
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $id = $request->input('row');
        $qtity = $request->input('qtyend');


        Cart::update($id, $qtity);


        $cart=Cart::get($id);
        if (auth()->user()) {

            $row = Cart::get($id);
            $user_id = auth()->user()->id;

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
                $cartdata->quantity = $row->qty;
                $cartdata->save();
            }
        }
$data['subtotal']=$cart->subtotal;
$data['total']=Cart::subtotal();
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bids  $bids
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        $id = $request->input('row');

        if (auth()->user()) {

            $row = Cart::get($id);
            $user_id = auth()->user()->id;

            $cartdata = Cart1::where('user_id', $user_id)->where('item_id', $row->id)->delete();
        }

        Cart::remove($id);
     


        return Cart::subtotal();
    
    }

}
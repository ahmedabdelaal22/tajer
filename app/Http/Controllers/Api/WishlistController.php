<?php

namespace App\Http\Controllers\Api;

use App\Wishlist;
use App\Bids;
use App\Messages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Items;
use App\Item_view;
use App\Item_images;
use App\Reviews;
use App\Notifications;
use Response;
use File;

class WishlistController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_wishlist($lang='ar',Request $request) {
        if (!empty($request->input('ItemID')) && !empty($request->input('UserID'))) {
            $id = hexdec(uniqid());
            $add = new Wishlist;
            $add->id = $id;
            $add->items_id = $request->input('ItemID');
            $add->user_id = $request->input('UserID');
           if($add->save()){
            return response()->json(['message' => 'Item added to favorite', 'status' => true], 200);
           }
        }
        return response()->json(['message' => 'required ItemID or UserID', 'status' => FALSE], 200);
    }

    public function remove_wishlist($lang='ar',Request $request) {
        if (!empty($request->input('ItemID')) && !empty($request->input('UserID'))) {


            Wishlist::where('items_id', $request->input('ItemID'))->where('user_id', $request->input('UserID'))->delete();

            return response()->json(['message' => 'Item removed from favorite', 'status' => true], 200);
        }
        return response()->json(['message' => 'required data', 'status' => FALSE], 200);
    }

    public function add_bids(Request $request) {
        if (!empty($request->input('ItemID')) && !empty($request->input('UserID')) && !empty($request->input('Auction'))) {
            $id = hexdec(uniqid());
            $add = new Bids;
            $add->id = $id;
            $add->items_id = $request->input('ItemID');
            $add->users_id = $request->input('UserID');
            $add->price = $request->input('Auction');
            $add->save();
            return response()->json(['message' => 'Bid sent', 'status' => true], 200);
        }
        return response()->json(['message' => 'required data', 'status' => FALSE], 200);
    }

    public function send_message(Request $request) {
        if (!empty($request->input('UserID')) && !empty($request->input('OwnerID')) && !empty($request->input('Message'))) {
            $id = hexdec(uniqid());


            $add = new Messages;
            $add->id = $id;
            $add->message = $request->input('Message');
            $add->receiver_id = $request->input('OwnerID');
            $add->sender_id = $request->input('UserID');
            $add->delete = 0;
            $add->save();
            return response()->json(['message' => 'Successfully', 'status' => true], 200);
        }
    }

    public function removeItem(Request $request) {
        if (!empty($request->input('ItemID'))) {
            $delte = Items::where('id', $request->input('ItemID'))->delete();
            if ($delte) {
                Wishlist::where('items_id', $request->input('ItemID'))->delete();
                Bids::where('items_id', $request->input('ItemID'))->delete();
                Item_view::where('items_id', $request->input('ItemID'))->delete();
                item_images::where('items_id', $request->input('ItemID'))->delete();
                Reviews::where('items_id', $request->input('ItemID'))->delete();
                Notifications::where('items_id', $request->input('ItemID'))->delete();
            }
            return response()->json(['message' => 'Item removed', 'status' => true], 200);
        }
        return response()->json(['message' => 'required data', 'status' => FALSE], 200);
    }

    public function updateItem(Request $request) {
        if (!empty($request->input('ItemID'))) {
           // dd($request->UserID);
            $edit = Items::find($request->input('ItemID'));
            if(!empty($request->input('UserID'))){
            $edit->user_id = $request->input('UserID');
            }
            if(!empty($request->input('Item_Title'))){
            $edit->title = $request->input('Item_Title');
            }
            if(!empty($request->input('Description'))){
            $edit->desc = $request->input('Description');
            }
            if(!empty($request->input('Sub_Category'))){
            $edit->sub_categories_id = $request->input('Sub_Category');
            }
            if(!empty($request->input('Status'))){
            $edit->status_id = $request->input('Status');
            }
            if(!empty($request->input('Brand_Sign'))){
            $edit->brands_id = $request->input('Brand_Sign');
            }
            if(!empty($request->input('City'))){
            $edit->cities_id = $request->input('City');
            }
            if(!empty($request->input('Location'))){
                $latlng= explode(',', $request->input('Location'));
            $edit->lat = $latlng[0];
            $edit->lng = $latlng[1];
            }
            if(!empty($request->input('Type'))){
            $edit->type = $request->input('Type');
            }
            if(!empty($request->input('Initial_Price'))){
            $edit->start_bid = $request->input('Initial_Price');
            }
            if(!empty($request->input('Buy_Price'))){
            $edit->fixed_price = $request->input('Buy_Price');
            }
            if(!empty($request->input('Low_Auction'))){
             $edit->min_bid = $request->input('Low_Auction');
            }
            if(!empty($request->input('Expire_Date'))){
             $edit->end_date = $request->input('Expire_Date');
            }
             $edit->save();
            return response()->json(['message' => 'Successfully edit auction', 'status' => TRUE,'result'=>$edit], 200);
        }
                return response()->json(['message' => 'required ItemID', 'status' => FALSE], 200);

    }
    public function uploadImage(Request $request){
      
           if(!empty($request->file('Image')))
        {
     $image=$request->file('Image');   
   
            $date_path= date("Y").'/'.date("m").'/'.date("d").'/';
                $path = public_path() . '/uploads/items/gallery/'.$date_path;

               if(!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
   
              }
               $file_name = date('YmdHis') . mt_rand() . '_items_gallery.' .$image->getClientOriginalExtension();
//        
//
            if ($image->move($path, $file_name))
                  {
             $img = '/public/uploads/items/gallery/' .$date_path.$file_name;

                 $id = abs( crc32( uniqid() ) );
                  $AddNewImage = new Item_images;
                $AddNewImage->id                        = $id;
                 $AddNewImage->items_id                   = $request->input('ItemID');
               $AddNewImage->image                         = $img;
         
                $AddNewImage->save();
                  return response()->json(['message' => 'Successfully add images', 'status' => TRUE], 200);
//     
//              
//
//
             }
        }
         
           return response()->json(['message' => 'required images', 'status' => FALSE], 200);

         
         
    }
    

}

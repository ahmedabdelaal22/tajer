<?php

namespace App\Http\Controllers\Frontend;

use App\Item_images;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests;
use Validator;
use Auth;
use App;

class ItemImagesController extends Controller {

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
     * @param  \App\Item_images  $item_images
     * @return \Illuminate\Http\Response
     */
    public function show(Item_images $item_images) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item_images  $item_images
     * @return \Illuminate\Http\Response
     */
    public function edit(Item_images $item_images) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item_images  $item_images
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item_images $item_images) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item_images  $item_images
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item_images $item_images) {
        //
    }

    public function delete_gallery_ajax(Request $request) {
        $id = $request->input('id');

        $delete = Item_images::findOrFail($id);
        $delete->delete();
        return $id;
    }

}

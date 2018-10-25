<?php

namespace App\Http\Controllers\Administrator;

use App\Item_images;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Validator;
use Auth;
use App;
use DB;
use File;
use Carbon\Carbon;

class ItemsImagesController extends Controller {

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
     * @param  \App\Items_images  $items_images
     * @return \Illuminate\Http\Response
     */
    public function show(Items_images $items_images) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Items_images  $items_images
     * @return \Illuminate\Http\Response
     */
    public function edit(Items_images $items_images) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Items_images  $items_images
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Items_images $items_images) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Items_images  $items_images
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items_images $items_images) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_gallery_ajax(Request $request) {
        $id = $request->input('id');

        $delete = Item_images::findOrFail($id);
        $delete->delete();
        return $id;
    }

}

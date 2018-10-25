<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('items', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->index();
            $table->bigInteger('user_id');
            $table->bigInteger('cities_id');
            $table->bigInteger('brands_id');
            $table->bigInteger('sub_categories_id');
            $table->bigInteger('status_id');
            $table->bigInteger('bids_id')->nullable()->default('0');

            $table->string('title');
            $table->longText('desc')->nullable();
            $table->string('thumbnail_image');

            $table->string('type');

            $table->datetime('start_date');
            $table->datetime('end_date');

            $table->string('start_bid');
            $table->string('min_bid');
            $table->string('fixed_price');

            $table->integer('active')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('items');
    }

}

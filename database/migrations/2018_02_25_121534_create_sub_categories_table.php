<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubCategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->index();
            $table->bigInteger('categories_id')->nullable();
            $table->string('ar_title')->nullable();
            $table->string('en_title')->nullable();
            $table->string('image')->nullable();
            $table->integer('active')->nullable()->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sub_categories');
    }

}

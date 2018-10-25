<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {

            $table->bigInteger('id')->primary()->index();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('phone')->nullable()->default('0');
            $table->string('image')->nullable();
            $table->bigInteger('cities_id')->nullable();
            $table->string('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();

            $table->integer('floor_num')->nullable();
            $table->integer('flat_num')->nullable();

            $table->string('about')->nullable();
            $table->string('facebook_profile')->nullable();
            $table->string('google_profile')->nullable();
            $table->string('twitter_profile')->nullable();

            $table->integer('type')->nullable();
            $table->integer('active')->nullable()->default('0');
            $table->string('permissions')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }

}

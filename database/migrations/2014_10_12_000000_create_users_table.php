<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::create('users', function (Blueprint $table) {
        //$table->id();
        //$table->string('name');
        //$table->string('email')->unique();
        //$table->timestamp('email_verified_at')->nullable();
        //$table->string('password');
        //$table->rememberToken();
        //$table->timestamps();
        //});

        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->foreignId('group_id')->constraint(); //changed this line
            $table->string('password');
            $table->string('status');
            $table->foreignId('created_by')->nullable();
            $table->foreignId('modified_by')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedInteger('profile_id');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('profile_id')
                ->references('id')
                ->on('profiles')
                ->onDelete('restrict');
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

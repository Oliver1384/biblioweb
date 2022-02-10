<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
            $table->string('password');
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestLoansTable extends Migration {

    public function up()
    {
        Schema::create('request_loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_loan_id');
            $table->unsignedBigInteger('user_loan_id');
            $table->foreign('book_loan_id')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_loan_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('request_loans');
    }
}

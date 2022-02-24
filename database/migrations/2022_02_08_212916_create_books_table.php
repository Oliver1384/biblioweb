<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{

    public function up() {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('author');
            $table->string('isbn');
            $table->string('editorial');
            $table->string('category');
            $table->string('image')->default('default-favicon.png');
            $table->string('url_pdf')->default('/images/pdf.png');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }


    public function down()
    {
        Schema::dropIfExists('books');
    }
}

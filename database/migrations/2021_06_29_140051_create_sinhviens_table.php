<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinhviensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinhviens', function (Blueprint $table) {
            $table->char('id', 15);
            $table->string("avatar")->default("/img/default-user-image.png");
            $table->string("fullname");
            $table->date("birthday");
            $table->string("address");
            $table->foreignId("class_id");
            $table->primary("id");
            $table->foreign('class_id')->references('id')->on('lop_hocs')->onDelete('cascade');    

            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
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
        Schema::dropIfExists('sinhviens');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("first_name", 100)->nullable();
            $table->string("last_name", 100);
            $table->date("dob");
            $table->string("email", 100);
            $table->string("mobile_number", 20);
            $table->char("gender", 11)->comment("[m: Male, f: Female]");
            $table->text("address", 300);
            $table->string("city", 100);
            $table->integer("pin_code");
            $table->string("state", 100);
            $table->string("country", 80);
            $table->string("hobbies", 100);
            $table->char("courses", 100);
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
        Schema::dropIfExists('students');
    }
};

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('baseid')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('profile')->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('role')->default('2')->comment('1=Admin, 2=Customer');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', ['1', '0'])->default(1)->comment('0=Inactive, 1=Active');
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
};

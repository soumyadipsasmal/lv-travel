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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('bid');
            $table->string('coustomerid');
            $table->integer('total');
            $table->text('pnames');
            $table->text('tgroup');
            $table->text('pcontact');
            $table->integer('created_by_role')->nullable();
            $table->integer('updated_by_role')->nullable();
            $table->string('created_by_ip')->nullable();
            $table->string('updated_by_ip')->nullable();
            $table->integer('del_flag')->default(1)->comment('0=Delete,1=Not Delete');
            $table->integer('status')->default(0)->comment('0=Failed,1=Pendeing,2=approve,3=complete');
            $table->softDeletesTz($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('bookings');
    }
};

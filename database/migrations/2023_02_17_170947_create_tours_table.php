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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->string('tour_name');
            $table->string('tour_price');
            $table->date('tour_start');
            $table->string('tour_duration');
            $table->string('tour_image');
            $table->string('tour_group');
            $table->string('tour_place');
            $table->string('tour_description');
            $table->string('tour_status')->default(1)->comment('1=Active,2=Inactive');
            $table->string('del_flag')->default(1)->comment('0=Delete,1=Not Delete');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('created_by_role')->nullable();
            $table->integer('updated_by_role')->nullable();
            $table->string('created_by_ip')->nullable();
            $table->string('updated_by_ip')->nullable();
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
        Schema::dropIfExists('tours');
    }
};

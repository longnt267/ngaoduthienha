<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->unsignedBigInteger('destination_id')->index('tours_destination_id_foreign');
            $table->unsignedBigInteger('type_tour_id')->index('tours_type_tour_id_foreign');
            $table->integer('duration')->default(1);
            $table->integer('price');
            $table->longText('description')->nullable();
            $table->string('image');
            $table->text('addtional_info')->nullable();
            $table->text('map')->nullable();
            $table->text('image_360')->nullable();
            $table->text('video')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1:active, 2:block');
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
}

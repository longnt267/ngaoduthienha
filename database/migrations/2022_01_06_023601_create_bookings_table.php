<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('booking_code', 50)->index()->nullable();
            $table->unsignedBigInteger('tour_id')->index('bookings_tour_id_foreign');
            $table->integer('number_people');
            $table->date('departure_date');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 100);
            $table->string('phone', 20);
            $table->string('address')->nullable();
            $table->string('city', 50)->nullable();
            $table->string('zip_code', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('payment_method')->comment('1:credit card, 2:paypal, 3:pay in cash');
            $table->tinyInteger('payment_status')->comment('1:unpaid, 2:paid')->default(1);
            $table->tinyInteger('status')->comment('1:new, 2:confirmed, 3:cancelled, 4:complete')->default(1);
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
}

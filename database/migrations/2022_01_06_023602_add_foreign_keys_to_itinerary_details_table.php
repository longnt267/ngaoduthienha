<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToItineraryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('itinerary_details', function (Blueprint $table) {
            $table->foreign(['itinerary_id'])->references(['id'])->on('itineraries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('itinerary_details', function (Blueprint $table) {
            $table->dropForeign('itinerary_details_itinerary_id_foreign');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCinemaSchema extends Migration
{
    /** ToDo: Create a migration that creates all tables for the following user stories

    For an example on how a UI for an api using this might look like, please try to book a show at https://in.bookmyshow.com/.
    To not introduce additional complexity, please consider only one cinema.

    Please list the tables that you would create including keys, foreign keys and attributes that are required by the user stories.

    ## User Stories

     **Movie exploration**
     * As a user I want to see which films can be watched and at what times
     * As a user I want to only see the shows which are not booked out

     **Show administration**
     * As a cinema owner I want to run different films at different times
     * As a cinema owner I want to run multiple films at the same time in different showrooms

     **Pricing**
     * As a cinema owner I want to get paid differently per show
     * As a cinema owner I want to give different seat types a percentage premium, for example 50 % more for vip seat

     **Seating**
     * As a user I want to book a seat
     * As a user I want to book a vip seat/couple seat/super vip/whatever
     * As a user I want to see which seats are still available
     * As a user I want to know where I'm sitting on my ticket
     * As a cinema owner I dont want to configure the seating for every show
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->timestamp();
        });
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->timestamp();
        });
        Schema::create('film_shifts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('film_id');
            $table->unsignedInteger('shift_id'); 
            $table->double('price_per_show'); 
            $table->timestamp();
        });
        Schema::create('showrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->timestamp();
        });
        Schema::create('seat_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('percentage');
            $table->timestamp();
        });

        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('showroom_id');
            $table->unsignedInteger('seat_type_id');
            $table->string('row');
            $table->integer('number');
            $table->timestamp();
        });

        Schema::create('booked_seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('seat_id');
            $table->unsignedInteger('shift_id'); 
            $table->timestamp();
        });

        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('booked_seat_id');
            $table->double('amount');

            $table->timestamp();
        });


        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}

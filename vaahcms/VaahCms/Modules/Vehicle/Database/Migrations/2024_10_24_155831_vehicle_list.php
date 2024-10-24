<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VehicleList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('vehicle_list')) {
            Schema::create('vehicle_list', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name')->nullable()->index();
                $table->string('company', 50);
                $table->string('model', 50);
                $table->integer('manufacturing_year');
                $table->string('color', 30)->nullable();
                $table->integer('mileage')->nullable();
                $table->enum('fuel_type', ['Petrol', 'Diesel', 'Electric', 'Hybrid']);
                $table->enum('transmission', ['Manual', 'Automatic']);
                $table->decimal('price', 10, 2)->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->index(['created_at', 'updated_at', 'deleted_at']);
                //----/common fields

            });
        }

    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('vehicle_list');
    }
}

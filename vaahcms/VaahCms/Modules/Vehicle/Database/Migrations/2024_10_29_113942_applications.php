<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Applications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('applications')) {
            Schema::create('applications', function (Blueprint $table) {
                $table->bigIncrements('id')->unsigned();
                $table->integer('customer_id')->nullable();
                $table->integer('vehicle_id')->nullable();
                $table->text('description')->nullable();
                $table->decimal('advance_amount',10,2)->nullable();
                $table->decimal('pending_amount',10,2)->nullable();
                $table->boolean('loan_applied')->nullable();
                $table->string('status')->nullable();
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
        Schema::dropIfExists('applications');
    }
}

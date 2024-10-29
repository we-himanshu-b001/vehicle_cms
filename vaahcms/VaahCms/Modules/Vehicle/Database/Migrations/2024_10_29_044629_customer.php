<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Customer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('customer')) {
            Schema::create('customer', function (Blueprint $table) {
                $table->bigIncrements('id')->unsigned();
                $table->string('name')->nullable()->index();

//                $table->boolean('is_active')->nullable()->index();
                $table->enum('gender',['male','female','other'])->nullable();
                $table->string('email')->nullable();
                $table->integer('phone_number')->nullable();
                //----common fields
                $table->text('address')->nullable();
//                $table->bigInteger('created_by')->nullable()->index();
//                $table->bigInteger('updated_by')->nullable()->index();
//                $table->bigInteger('deleted_by')->nullable()->index();
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
        Schema::dropIfExists('customer');
    }
}

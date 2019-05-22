<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_metas', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('consumer_type');
            $table->string('username');
            $table->string('post_code');            
            $table->string('address');            
            $table->string('city');            
            $table->string('town');            
            $table->string('country');            
            $table->string('reference');            
            $table->string('additional_info');            
            $table->integer('fee');            
            $table->timestamp('time_to_charge');            
            $table->timestamp('time_to_pay');            
            $table->string('customer_id');            
            $table->string('charge_km');            
            $table->string('maximum_km');            
            $table->string('translator_type');            
            $table->string('worked_for');            
            $table->integer('organization_number');            
            $table->string('gender');            
            $table->string('translator_level');            
            $table->string('post_code');            
            $table->string('address');            
            $table->string('address_2');            
            $table->string('town');            
            
            $table->integer('user_id');
            $table->integer('worked_for');

            $table->integer('company_id');

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
        Schema::dropIfExists('user_metas');
    }
}

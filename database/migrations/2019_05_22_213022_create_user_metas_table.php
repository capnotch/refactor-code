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
            
            $table->string('consumer_type')->default('');
            $table->string('username')->default('');
            $table->string('customer_type')->default('');
            $table->string('cost_place')->default('');
            $table->string('charge_ob')->default('');
            $table->string('post_code')->default('');           
            $table->string('address')->default('');           
            $table->string('address_2')->default('');        
            $table->string('city')->default('');           
            $table->string('town')->default('');            
            $table->string('country')->default('');          
            $table->string('reference')->default('');           
            $table->string('additional_info')->default('');          
            $table->string('fee')->default('');            
            $table->string('time_to_charge')->default('');            
            $table->string('time_to_pay')->default('');           
            $table->string('customer_id')->default('');           
            $table->string('charge_km')->default('');            
            $table->string('maximum_km')->default('');            
            $table->string('translator_type')->default('');            
            $table->string('worked_for')->default('');           
            $table->string('organization_number')->default('');            
            $table->string('gender')->default('');            
            $table->string('translator_level')->default('');           
            
            $table->string('user_id')->default('');

            $table->string('company_id')->default('');

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

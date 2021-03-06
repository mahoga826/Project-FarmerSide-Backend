<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
			$table->string('loan_id')->unique();
			$table->string('bank_id');
			$table->string('loan_name');
			$table->string('genera_info');
			$table->string('specific_info');
			$table->string('eligible_borrowers');
			$table->string('eligible_crops');
			$table->string('maximum_loanamount');
			$table->string('Rateofinterest');
			$table->string('Repaymentperiod');
			$table->string('more_info');
			$table->binary('loan_logo');
			
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
        Schema::dropIfExists('loans');
    }
}

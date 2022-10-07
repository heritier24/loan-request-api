<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('names');
            $table->string('gender');
            $table->string('phonenumber');
            $table->string('nid');
            $table->string('salary');
            $table->string('commitment');
            $table->string('district'); // set district from distrct api selection 
            $table->string('sector');   // sector here must be in the district selected 
            $table->string('company');
            $table->string('position');  // manager, contable , cashier, recovery, loan officer , other
            $table->string('other')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('clients');
    }
};

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
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clientID');  // foreign key client ID 
            $table->unsignedBigInteger('itemID');    // foreign key item ID 
            $table->text('note')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();

            $table->foreign('clientID')->references('id')->on('Clients')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('itemID')->references('id')->on('Items')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_requests');
    }
};

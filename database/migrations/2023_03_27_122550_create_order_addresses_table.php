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
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->enum('type',['billing','shipping']);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone_number',30);
            $table->string('street_address');
            $table->foreignId('governorate_id')->nullable()->constrained('destinations')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('destinations')->nullOnDelete();
            $table->foreignId('neighborhood_id')->nullable()->constrained('destinations')->nullOnDelete();
            // $table->char('country',2)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_addresses');
    }
};

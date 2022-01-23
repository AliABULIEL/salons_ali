<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('client_id')->index();
            $table->unsignedBigInteger('business_id')->index();
            $table->json('services')->nullable();
            $table->double('total');
            $table->integer('minutes');
            $table->timestamp('starting_at')->nullable();
            $table->timestamp('ending_at')->nullable();
            $table->boolean('should_approved')->default(0);
            $table->boolean('approved')->default(0);
            $table->boolean('canceled')->default(0);
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
        Schema::dropIfExists('orders');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->json('name')->nullable();
            $table->json('intro')->nullable();
            $table->json('about')->nullable();
            $table->json('address')->nullable();
            $table->json('working_days')->nullable();
            $table->string('logo')->nullable();
            $table->string('cover')->nullable();
            $table->string('primary_color')->nullable();
            $table->json('social_links')->nullable();

            $table->integer('order_min_days')->default(0);
            $table->integer('cancel_min_days')->default(0);
            $table->integer('edit_min_days')->default(0);

            $table->string('google_address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->json('address_text')->nullable();
            $table->string('address_image')->nullable();
            $table->boolean('sms_notifications');
            $table->boolean('push_notifications');

            $table->unsignedBigInteger('user_id')->nullable()->index();
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
        Schema::dropIfExists('businesses');
    }
}

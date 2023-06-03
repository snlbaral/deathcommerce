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
        Schema::create('country_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('stripe_currency');
            $table->string('store_currency');
            $table->string('system_language');
            $table->string('store_language');
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
        Schema::dropIfExists('country_settings');
    }
};

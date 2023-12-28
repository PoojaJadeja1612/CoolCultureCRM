<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('companyName');
            $table->string('gst');
            $table->string('pan');
            $table->string('companyEmail');
            $table->string('companyPhone');
            $table->string('addressLine1');
            $table->string('addressLine2');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('pincode');
            $table->string('companySmallLogo');
            $table->string('companyLogo');
            $table->string('companyFavicon');
            $table->string('primaryColor');
            $table->string('secondaryColor');
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
        Schema::dropIfExists('settings');
    }
}
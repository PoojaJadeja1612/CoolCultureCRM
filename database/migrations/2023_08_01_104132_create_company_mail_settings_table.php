<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyMailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_mail_settings', function (Blueprint $table) {
            $table->id();
            $table->string('mailer');
            $table->string('host');
            $table->string('port');
            $table->string('encryption');
            $table->string('userName');
            $table->string('password');
            $table->string('fromAddress');
            $table->string('fromName');
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
        Schema::dropIfExists('company_mail_settings');
    }
}

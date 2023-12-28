<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProxyLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proxy_logins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proxy_id'); // The user performing the proxy login
            $table->unsignedBigInteger('user_id'); // The user being impersonated
            $table->timestamp('expires_at')->nullable(); // Optional: For expiration time of the proxy login
            $table->timestamps();

            // Add foreign keys to link to the users table
            $table->foreign('proxy_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proxy_logins');
    }
}
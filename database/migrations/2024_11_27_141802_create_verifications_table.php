<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationsTable extends Migration
{
    public function up()
    {
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->morphs('verifiable');
            $table->string('code');
            $table->string('email')->unique();
            $table->boolean('is_verified')->default(false);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('verifications');
    }
}

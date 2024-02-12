<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('crypto_portfolio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('crypto_id');
            $table->string('crypto_address')->nullable();
            $table->decimal('balance', 18, 8)->default(0);
            $table->timestamps();
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('crypto_id')->references('id')->on('crypto')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crypto_portfolio');
    }
};

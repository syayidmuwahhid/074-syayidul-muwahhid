<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('tags');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('user_add');
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('user_add')->references('id')->on('users');
            // $table->foreign('status_id')->references('id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

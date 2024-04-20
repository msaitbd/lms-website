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
        Schema::create('bkash_payment_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('bkash_trxid')->nullable();
            $table->text('bkash_from_number')->nullable();
            $table->text('amount')->nullable();
            $table->text('image')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkash_payment_requests');
    }
};

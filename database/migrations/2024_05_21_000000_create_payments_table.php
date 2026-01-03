<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->decimal('amount', 15, 2);
            $table->string('status')->default('pending'); // pending, paid, failed
            $table->timestamp('payment_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint
            // Pastikan tabel bookings sudah dibuat sebelum migration ini
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->string('external_id')->unique();

            $table->decimal('amount', 10, 2);

            $table->enum('status', [
                'pending',
                'processing',
                'approved',
                'failed'
            ]);

            $table->timestamps();

            $table->string('idempotency_key')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

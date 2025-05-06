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
        Schema::create('budget_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funding_request_id');
            $table->string('description');
            $table->string('unit');
            $table->double('unit_cost');
            $table->double('quantity');
            $table->double('total_cost');
            $table->double('actual_cost')->default(0);
            $table->double('variance')->default(0);
            $table->boolean('status')->default(true);
            $table->boolean('is_purchased')->default(false);
            $table->boolean('flagged')->default(false);
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->boolean('has_recommendation')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_items');
    }
};

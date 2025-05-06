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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('budget_item_id');
            $table->unsignedBigInteger('supplier_id');
            $table->double('cost');
            $table->double('meets_specs')->default(0);
            $table->string('recommendation_comment')->nullable();
            $table->string('approver_comment')->nullable();
            $table->string('path')->nullable();
            $table->boolean('is_recommend')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->unsignedBigInteger('organisation_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};

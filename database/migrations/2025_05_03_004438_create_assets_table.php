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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_no');
            $table->string('name');
            $table->string('description');
            $table->decimal('purchase_price');
            $table->date('purchase_date');
            $table->string('assigned_to');
            $table->string('status')->default('active');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('organisation_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};

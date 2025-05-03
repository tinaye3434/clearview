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
        Schema::create('funding_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('organisation_id');
            $table->string('title');
            $table->text('description');
            $table->double('target_amount')->default(0);
            $table->double('raised_amount')->default(0);
            $table->string('status')->default('pending');
            $table->boolean('is_funded')->default(false);
            $table->string('image')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->unsignedInteger('approver_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funding_requests');
    }
};

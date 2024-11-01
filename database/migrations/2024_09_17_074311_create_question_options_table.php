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
        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_bank_id');
            $table->text('option_text');
            $table->boolean('is_correct')->default(false);
            $table->text('interpretation')->nullable();
            $table->timestamps();
            $table->foreign('question_bank_id')->references('id')->on('question_banks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_options');
    }
};

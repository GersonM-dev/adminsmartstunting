<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anak_id');
            $table->timestamp('timestamp');
            $table->string('status_stunting');
            $table->string('status_underweight');
            $table->string('status_wasting');
            $table->text('rekomendasi');
            $table->timestamps();

            $table->foreign('anak_id')->references('id')->on('anaks')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayats');
    }
};

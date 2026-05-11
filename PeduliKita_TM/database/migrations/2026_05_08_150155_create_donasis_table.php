<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('donasis', function (Blueprint $table) {
        $table->id();

        $table->foreignId('program_donasi_id')->constrained()->cascadeOnDelete();

        $table->foreignId('donatur_id')->constrained()->cascadeOnDelete();

        $table->bigInteger('jumlah');

        $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};

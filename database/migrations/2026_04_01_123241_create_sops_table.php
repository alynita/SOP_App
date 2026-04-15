<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sops', function (Blueprint $table) {
            $table->id();
            $table->string('no_sop');
            $table->string('nama_sop');
            $table->date('tgl_pembuatan')->nullable();
            $table->date('tgl_revisi')->nullable();
            $table->date('tgl_efektif')->nullable();
            $table->string('disahkan_oleh')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sops');
    }
};
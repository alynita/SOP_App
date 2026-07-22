<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sops', function (Blueprint $table) {
            $table->foreignId('sop_induk_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('sops')
                    ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('sops', function (Blueprint $table) {
            $table->dropForeign(['sop_induk_id']);
            $table->dropColumn('sop_induk_id');
        });
    }
};

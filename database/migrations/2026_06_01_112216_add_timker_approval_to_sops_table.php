<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sops', function (Blueprint $table) {

            $table->string('timker_approved_by')->nullable()->after('status');
            $table->timestamp('timker_approved_at')->nullable()->after('timker_approved_by');

        });
    }

    public function down(): void
    {
        Schema::table('sops', function (Blueprint $table) {

            $table->dropColumn('timker_approved_by');
            $table->dropColumn('timker_approved_at');

        });
    }
};
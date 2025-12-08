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
        Schema::table('langues', function (Blueprint $table) {
            $table->string('code_langue', 10)->after('libelle');
            $table->text('description')->nullable()->after('code_langue');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('langues', function (Blueprint $table) {
            $table->dropColumn('code_langue');
            $table->dropColumn('description');
        });
    }
};

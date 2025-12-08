<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('contenus', function (Blueprint $table) {
            if (!Schema::hasColumn('contenus', 'is_premium')) {
                $table->boolean('is_premium')->default(false)->after('texte');
            }
            if (!Schema::hasColumn('contenus', 'prix')) {
                $table->integer('prix')->default(300)->after('is_premium');
            }
        });
    }

    public function down()
    {
        Schema::table('contenus', function (Blueprint $table) {
            if (Schema::hasColumn('contenus', 'prix')) {
                $table->dropColumn('prix');
            }
            if (Schema::hasColumn('contenus', 'is_premium')) {
                $table->dropColumn('is_premium');
            }
        });
    }
};

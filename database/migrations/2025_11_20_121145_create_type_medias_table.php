<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('type_medias', function (Blueprint $table) {
            $table->id('id_type_media');
            $table->string('nom_media');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('type_medias');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('medias', function (Blueprint $table) {
            $table->id('id_media');
            $table->string('chemin');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('id_contenu');
            $table->unsignedBigInteger('id_type_media');

            $table->foreign('id_contenu')->references('id_contenu')->on('contenus')->onDelete('cascade');
            $table->foreign('id_type_media')->references('id_type_media')->on('type_medias');

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('medias');
    }
};

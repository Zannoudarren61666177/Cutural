<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id('id_commentaire');
            $table->text('texte');
            $table->integer('note')->nullable();
            $table->date('date')->nullable();

            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_contenu');

            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_contenu')->references('id_contenu')->on('contenus')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
};

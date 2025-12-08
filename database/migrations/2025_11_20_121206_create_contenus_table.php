<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('contenus', function (Blueprint $table) {
            $table->id('id_contenu');
            $table->string('titre');
            $table->longText('texte')->nullable();
            $table->date('date_creation')->nullable();
            $table->string('statut')->default('en_attente');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->date('date_validation')->nullable();

            $table->unsignedBigInteger('id_region')->nullable();
            $table->unsignedBigInteger('id_langue')->nullable();
            $table->unsignedBigInteger('id_moderateur')->nullable();
            $table->unsignedBigInteger('id_type_contenu');
            $table->unsignedBigInteger('id_auteur');

            $table->foreign('parent_id')->references('id_contenu')->on('contenus')->onDelete('cascade');
            $table->foreign('id_region')->references('id_region')->on('regions');
            $table->foreign('id_langue')->references('id_langue')->on('langues');
            $table->foreign('id_moderateur')->references('id_user')->on('users');
            $table->foreign('id_type_contenu')->references('id_type_contenu')->on('type_contenus');
            $table->foreign('id_auteur')->references('id_user')->on('users');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contenus');
    }
};

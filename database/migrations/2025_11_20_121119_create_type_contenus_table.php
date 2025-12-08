<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('type_contenus', function (Blueprint $table) {
            $table->id('id_type_contenu');
            $table->string('libelle_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('type_contenus');
    }
};

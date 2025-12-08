<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('user_id')
                  ->constrained('users', 'id_user')
                  ->onDelete('cascade');

            $table->foreignId('contenu_id')
                  ->constrained('contenus', 'id_contenu')
                  ->onDelete('cascade');

            // Paiement
            $table->integer('montant')->default(300);
            $table->string('statut')->default('en_attente');

            // Identifiants Fedapay
            $table->string('transaction_id')->nullable(); // ID réel FedaPay
            $table->string('fedapay_token')->nullable();  // ID transaction locale

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('commandes');
    }
};

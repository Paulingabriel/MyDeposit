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
        Schema::create('casiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fournisseur_id')->nullable()->constrained('fournisseurs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('bouteille_id')->nullable()->constrained('bouteilles')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('capacite');
            $table->integer('prix_achat');
            $table->string('intitule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casiers');
    }
};

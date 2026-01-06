<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('billets', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->decimal('prix', 8, 2);
            $table->integer('quantite');
            $table->integer('quantite_totale')->nullable();
            $table->integer('quantite_disponible')->nullable();
            $table->integer('quantite_vendue')->nullable();
            $table->foreignId('evenement_id')->constrained('evenements')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bilets');
    }
};

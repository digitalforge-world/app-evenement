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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('evenement_id')->constrained()->onDelete('cascade');
            $table->foreignId('billet_id')->constrained()->onDelete('cascade');

            // Informations d'achat
            $table->string('code_achat')->unique();
            $table->string('nom_acheteur');
            $table->string('email_acheteur');
            $table->integer('quantite');
            $table->decimal('prix_unitaire', 10, 2);
            $table->decimal('montant_total', 10, 2);

            // Informations de paiement
            $table->string('stripe_charge_id')->nullable();
            $table->enum('status', ['pending', 'success', 'failed', 'refunded'])->default('pending');
            $table->string('payment_method')->default('stripe');
            $table->timestamp('date_achat')->nullable();

            // QR Code
            $table->string('qr_code_path')->nullable();
            $table->text('qr_data')->nullable();

            // Scan tracking
            $table->boolean('is_scanned')->default(false);
            $table->integer('scan_count')->default(0);
            $table->timestamp('first_scan_at')->nullable();
            $table->timestamp('last_scan_at')->nullable();
            $table->foreignId('scanned_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();

            // Index pour améliorer les performances
            $table->index('code_achat');
            $table->index('email_acheteur');
            $table->index(['evenement_id', 'status']);
            $table->index('is_scanned');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

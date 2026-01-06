<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'achat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
        }
        .email-header p {
            margin: 10px 0 0;
            opacity: 0.9;
        }
        .email-body {
            padding: 30px;
        }
        .success-icon {
            text-align: center;
            margin-bottom: 20px;
        }
        .success-icon svg {
            width: 80px;
            height: 80px;
            fill: #28a745;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #6f42c1;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .info-box h3 {
            margin-top: 0;
            color: #6f42c1;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #666;
        }
        .info-value {
            color: #333;
        }
        .qr-code-section {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            margin: 20px 0;
        }
        .qr-code-section img {
            max-width: 250px;
            margin: 15px auto;
        }
        .warning-box {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .warning-box strong {
            color: #856404;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #6f42c1;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 5px;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #5a32a3;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
        .total-amount {
            background-color: #6f42c1;
            color: white;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
        }
        .total-amount h2 {
            margin: 0;
            font-size: 32px;
        }
        ul {
            padding-left: 20px;
        }
        ul li {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- En-tête -->
        <div class="email-header">
            <h1>🎉 Confirmation d'achat</h1>
            <p>Votre commande a été confirmée avec succès !</p>
        </div>

        <!-- Corps de l'email -->
        <div class="email-body">
            <!-- Icône de succès -->
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>

            <p>Bonjour <strong>{{ $transaction->nom_acheteur }}</strong>,</p>

            <p>Nous vous confirmons que votre commande de billets a bien été enregistrée et payée. Vous trouverez ci-dessous tous les détails de votre achat.</p>

            <!-- Informations de commande -->
            <div class="info-box">
                <h3>📋 Informations de commande</h3>
                <div class="info-row">
                    <span class="info-label">Code de commande :</span>
                    <span class="info-value"><strong>{{ $transaction->code_achat }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Date d'achat :</span>
                    <span class="info-value">{{ $transaction->formatted_date_achat }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Statut :</span>
                    <span class="info-value" style="color: #28a745;">✅ Confirmé</span>
                </div>
            </div>

            <!-- Détails de l'événement -->
            <div class="info-box">
                <h3>🎫 Détails de l'événement</h3>
                <div class="info-row">
                    <span class="info-label">Événement :</span>
                    <span class="info-value"><strong>{{ $evenement->titre }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Date :</span>
                    <span class="info-value">{{ $evenement->formatted_date_long }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Horaires :</span>
                    <span class="info-value">{{ $evenement->formatted_start_time }} - {{ $evenement->formatted_end_time }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Lieu :</span>
                    <span class="info-value">{{ $evenement->lieu }}</span>
                </div>
            </div>

            <!-- Détails des billets -->
            <div class="info-box">
                <h3>🎟️ Détails des billets</h3>
                <div class="info-row">
                    <span class="info-label">Type de billet :</span>
                    <span class="info-value"><strong>{{ $billet->type }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Quantité :</span>
                    <span class="info-value">{{ $transaction->quantite }} billet(s)</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Prix unitaire :</span>
                    <span class="info-value">{{ number_format($transaction->prix_unitaire, 0, ',', ' ') }} FCFA</span>
                </div>
            </div>

            <!-- Montant total -->
            <div class="total-amount">
                <p style="margin: 0; font-size: 14px;">Montant total payé</p>
                <h2>{{ $transaction->formatted_montant }}</h2>
            </div>

            <!-- QR Code -->
            <div class="qr-code-section">
                <h3 style="color: #6f42c1;">📱 Votre QR Code d'accès</h3>
                <p>Présentez ce QR code à l'entrée de l'événement</p>
                @if(isset($qrCodePath) && file_exists($qrCodePath))
                    <img src="{{ $qrCodePath }}" alt="QR Code" style="border: 3px solid #6f42c1; border-radius: 10px;">
                @endif
                <p style="margin-top: 15px;"><small>Le QR code est également disponible en pièce jointe</small></p>
            </div>

            <!-- Avertissement -->
            <div class="warning-box">
                <strong>⚠️ Important :</strong> Ce QR code ne peut être scanné qu'une seule fois. Conservez-le précieusement jusqu'au jour de l'événement.
            </div>

            <!-- Instructions -->
            <div class="info-box">
                <h3>📝 Instructions importantes</h3>
                <ul>
                    <li>Conservez ce QR code sur votre téléphone ou imprimez-le</li>
                    <li>Arrivez 15-30 minutes avant le début de l'événement</li>
                    <li>Une pièce d'identité pourra vous être demandée à l'entrée</li>
                    <li>Le QR code doit être scanné pour chaque personne</li>
                    <li>En cas de problème, contactez-nous immédiatement</li>
                </ul>
            </div>

            <!-- Boutons d'action -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('p.confirmation', $transaction->id) }}" class="btn">
                    Voir ma commande
                </a>
                <a href="{{ route('p.transaction.download-qr', $transaction->id) }}" class="btn" style="background-color: #28a745;">
                    Télécharger le QR Code
                </a>
            </div>

            <p>Si vous avez des questions, n'hésitez pas à nous contacter à <a href="mailto:support@example.com">support@example.com</a></p>

            <p>Merci pour votre confiance et à très bientôt !</p>
        </div>

        <!-- Pied de page -->
        <div class="email-footer">
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
            <p>&copy; {{ date('Y') }} Votre Plateforme d'Événements. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>

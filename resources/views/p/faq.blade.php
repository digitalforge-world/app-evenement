@extends('layouts.base')
@section('title','FAQ')
@section('content')


    <style>
        :root {
            --primary-blue: #1a73e8;
            --secondary-blue: #4285f4;
            --light-blue: #e8f0fe;
            --dark-blue: #0d47a1;
            --accent-blue: #64b5f6;
        }
        
        
        .header {
            background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
            color: white;
            text-align: center;
            padding: 3rem 1rem;
            border-bottom: 5px solid var(--accent-blue);
        }
        
        
        h1 {
            margin: 0;
            font-size: 2.5rem;
        }
        
        .subtitle {
            font-size: 1.2rem;
            margin-top: 0.5rem;
            opacity: 0.9;
        }
        
        .faq-search {
            margin: 2rem auto;
            max-width: 600px;
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 15px 20px;
            border-radius: 30px;
            border: 2px solid var(--accent-blue);
            font-size: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            outline: none;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            border-color: var(--primary-blue);
        }
        
        .search-button {
            position: absolute;
            right: 5px;
            top: 5px;
            background-color: var(--primary-blue);
            border: none;
            color: white;
            border-radius: 30px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .search-button:hover {
            background-color: var(--dark-blue);
        }
        
        .faq-categories {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 2rem;
        }
        
        .category-button {
            background-color: white;
            border: 2px solid var(--accent-blue);
            color: var(--dark-blue);
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .category-button:hover, .category-button.active {
            background-color: var(--primary-blue);
            color: white;
        }
        
        .faq-section {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        .faq-section h2 {
            color: var(--dark-blue);
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-blue);
        }
        
        .faq-item {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--light-blue);
            padding-bottom: 1.5rem;
        }
        
        .faq-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .faq-question {
            font-weight: 600;
            color: var(--primary-blue);
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }
        
        .faq-question span {
            flex: 1;
        }
        
        .faq-question::after {
            content: "+";
            font-size: 1.5rem;
            margin-left: 10px;
            transition: transform 0.3s ease;
            min-width: 24px;
            text-align: center;
        }
        
        .faq-question.active::after {
            content: "−";
            transform: rotate(180deg);
        }
        
        .faq-answer {
            display: none;
            padding: 0.5rem 0;
            color: #555;
        }
        
        .faq-answer.show {
            display: block;
        }
        
        .cta-section {
            text-align: center;
            margin-top: 3rem;
            background: linear-gradient(135deg, var(--light-blue), #fff);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .cta-section h3 {
            color: var(--dark-blue);
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .contact-button {
            background-color: var(--primary-blue);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        
        .contact-button:hover {
            background-color: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        
        
        @media (max-width: 768px) {
            .header {
                padding: 2rem 1rem;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            .container {
                padding: 1rem;
            }
            
            .faq-section {
                padding: 1.5rem;
            }
        }
    </style>

    <div class="header">
        <h1>Foire Aux Questions</h1>
        <div class="subtitle">Tout ce que vous devez savoir sur notre plateforme d'événements</div>
    </div>
    
    <div class="container">

        <div class="faq-section">
            <h2>Questions Générales</h2>
            
            <div class="faq-item">
                <div class="faq-question"><span>Qu'est-ce que cette plateforme?</span></div>
                <div class="faq-answer">
                    Notre plateforme est un service complet de gestion et de vente d'événements. Nous permettons aux organisateurs de créer et gérer des événements, et aux participants d'acheter facilement des billets pour y assister. Que ce soit pour des concerts, des conférences, des ateliers ou des festivals, notre site vous connecte aux événements qui vous intéressent.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question"><span>Comment puis-je créer un compte?</span></div>
                <div class="faq-answer">
                    Pour créer un compte, cliquez sur le bouton "S'inscrire" en haut à droite de la page d'accueil. Vous pouvez vous inscrire avec votre adresse e-mail, ou utiliser vos comptes Google ou Facebook pour une inscription rapide. Une fois inscrit, vous pourrez accéder à votre tableau de bord personnel.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question"><span>Est-ce que je peux utiliser la plateforme sans créer de compte?</span></div>
                <div class="faq-answer">
                    Vous pouvez parcourir les événements disponibles sans créer de compte, mais un compte est nécessaire pour acheter des billets ou s'inscrire à des événements. Cela nous permet de sécuriser vos achats et de vous fournir les informations importantes concernant les événements auxquels vous participez.
                </div>
            </div>
        </div>
        
        <div class="faq-section">
            <h2>Billets et Inscriptions</h2>
            
            <div class="faq-item">
                <div class="faq-question"><span>Comment acheter des billets pour un événement?</span></div>
                <div class="faq-answer">
                    Pour acheter des billets, naviguez vers la page de l'événement qui vous intéresse, sélectionnez le type et la quantité de billets souhaités, puis cliquez sur "Acheter". Suivez les instructions pour compléter le paiement. Une fois la transaction terminée, vous recevrez vos billets par e-mail et ils seront également disponibles dans votre compte.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question"><span>Puis-je transférer mon billet à quelqu'un d'autre?</span></div>
                <div class="faq-answer">
                    Oui, vous pouvez transférer vos billets à une autre personne. Dans votre compte, accédez à "Mes billets", sélectionnez le billet que vous souhaitez transférer, puis cliquez sur "Transférer". Vous devrez fournir l'adresse e-mail du destinataire. Notez que certains événements peuvent avoir des restrictions sur les transferts de billets.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question"><span>Comment puis-je obtenir un remboursement?</span></div>
                <div class="faq-answer">
                    Les politiques de remboursement varient selon les événements et sont fixées par les organisateurs. Pour demander un remboursement, consultez d'abord la politique de remboursement sur la page de l'événement. Si les remboursements sont autorisés, vous pouvez faire votre demande via la section "Mes billets" de votre compte. Notez que des frais de traitement peuvent s'appliquer.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question"><span>Que faire si je perds mes billets?</span></div>
                <div class="faq-answer">
                    Pas d'inquiétude! Vos billets sont toujours disponibles dans votre compte. Connectez-vous, allez dans la section "Mes billets" et vous pourrez les consulter ou les télécharger à nouveau. Vous pouvez également vérifier votre e-mail pour retrouver la confirmation d'achat avec les billets en pièce jointe.
                </div>
            </div>
        </div>
        
        <div class="faq-section">
            <h2>Paiements et Sécurité</h2>
            
            <div class="faq-item">
                <div class="faq-question"><span>Quels modes de paiement acceptez-vous?</span></div>
                <div class="faq-answer">
                    Nous acceptons les cartes de crédit et de débit (Visa, Mastercard, American Express), PayPal, et dans certains pays, des options de paiement local comme Apple Pay, Google Pay, et des virements bancaires. Les options disponibles s'afficheront lors du processus de paiement.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question"><span>Mes informations de paiement sont-elles sécurisées?</span></div>
                <div class="faq-answer">
                    Absolument. Nous utilisons un cryptage SSL de pointe pour protéger toutes vos données personnelles et financières. Nous ne stockons pas les informations complètes de votre carte de crédit sur nos serveurs. Nos processus de paiement sont conformes aux normes PCI DSS (Payment Card Industry Data Security Standard).
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question"><span>Y a-t-il des frais supplémentaires lors de l'achat de billets?</span></div>
                <div class="faq-answer">
                    Des frais de service peuvent s'appliquer lors de l'achat de billets. Ces frais couvrent les coûts de traitement des paiements et de maintenance de la plateforme. Tous les frais sont clairement indiqués avant la finalisation de votre achat, donc pas de surprises.
                </div>
            </div>
        </div>
        
        <div class="faq-section">
            <h2>Événements</h2>
            
            <div class="faq-item">
                <div class="faq-question"><span>Comment puis-je trouver des événements qui m'intéressent?</span></div>
                <div class="faq-answer">
                    Vous pouvez parcourir les événements par catégorie, date, lieu ou utiliser notre barre de recherche pour trouver des événements spécifiques. Nous proposons également des recommandations personnalisées basées sur vos intérêts et votre historique de participation. N'oubliez pas de vous abonner à notre newsletter pour recevoir des mises à jour sur les nouveaux événements.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question"><span>Que se passe-t-il si un événement est annulé?</span></div>
                <div class="faq-answer">
                    Si un événement est annulé, vous serez notifié par e-mail. Dans la plupart des cas, un remboursement automatique sera traité selon les modalités définies par l'organisateur. Ces informations seront communiquées dans l'e-mail de notification. Vous pouvez également consulter le statut de vos remboursements dans la section "Mes billets" de votre compte.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question"><span>Comment puis-je contacter l'organisateur d'un événement?</span></div>
                <div class="faq-answer">
                    Sur la page de l'événement, vous trouverez une section "Contacter l'organisateur" où vous pourrez envoyer un message directement à l'équipe d'organisation. Si vous avez déjà acheté un billet, vous pouvez également les contacter via la section "Mes billets" de votre compte.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question"><span>Puis-je organiser mon propre événement sur votre plateforme?</span></div>
                <div class="faq-answer">
                    Oui, absolument! Pour créer votre propre événement, vous devez d'abord créer un compte organisateur. Cliquez sur "Devenir organisateur" dans le menu principal et suivez les instructions. Une fois votre compte validé, vous pourrez créer et gérer vos événements, vendre des billets et suivre les inscriptions.
                </div>
            </div>
        </div>
        
        <div class="faq-section">
            <h2>Support et Assistance</h2>
            
            <div class="faq-item">
                <div class="faq-question"><span>Comment puis-je contacter le service client?</span></div>
                <div class="faq-answer">
                    Vous pouvez nous contacter de plusieurs façons: par e-mail à support@evenement.com, par chat en direct sur le site (disponible de 9h à 18h), ou par téléphone au 01 23 45 67 89 (du lundi au vendredi, de 9h à 17h). Nous nous efforçons de répondre à toutes les demandes dans un délai de 24 heures.
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question"><span>J'ai un problème technique avec le site, que faire?</span></div>
                <div class="faq-answer">
                    Si vous rencontrez des difficultés techniques, essayez d'abord d'actualiser la page ou de vider le cache de votre navigateur. Si le problème persiste, contactez notre équipe de support technique en précisant votre navigateur, votre appareil et une description détaillée du problème. Des captures d'écran sont toujours utiles pour nous aider à diagnostiquer le problème.
                </div>
            </div>
        </div>
        
        <div class="cta-section">
            <h3>Vous n'avez pas trouvé la réponse à votre question?</h3>
            <p>Notre équipe de support est disponible pour vous aider avec toutes vos questions et préoccupations.</p>
            <a href="#" class="contact-button">Contactez-nous</a>
        </div>
    </div>
    

    
    <script>
        // Script pour rendre les FAQ interactives
        document.addEventListener('DOMContentLoaded', function() {
            const questions = document.querySelectorAll('.faq-question');
            
            questions.forEach(question => {
                question.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    
                    // Toggle active class on question
                    this.classList.toggle('active');
                    
                    // Toggle show class on answer
                    if (answer.classList.contains('show')) {
                        answer.classList.remove('show');
                    } else {
                        answer.classList.add('show');
                    }
                });
            });
            
            // Simuler les fonctionnalités de recherche et de catégories
            const categoryButtons = document.querySelectorAll('.category-button');
            
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    categoryButtons.forEach(btn => btn.classList.remove('active'));
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                });
            });
        });
    </script>

@endsection

@extends('layouts.base')
@section('title','A propos')
@section('content')

    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #6366f1;
            --accent-color: #f43f5e;
            --light-bg: #f9fafb;
            --dark-text: #1f2937;
            --light-text: #f9fafb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-bg);
            color: var(--dark-text);
            line-height: 1.6;
        }

        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 0.5rem;
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-left: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark-text);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--primary-color);
        }

        .auth-buttons {
            display: flex;
            align-items: center;
        }

        .auth-buttons a {
            text-decoration: none;
            margin-left: 1rem;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-outline {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }

        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        /* Hero Section */
        .about-hero {
            background: linear-gradient(to right, rgba(79, 70, 229, 0.9), rgba(99, 102, 241, 0.8)), url('/api/placeholder/1200/400') no-repeat center center/cover;
            color: white;
            padding: 5rem 0;
            text-align: center;
        }

        .about-hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .about-hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .about-hero p {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        /* About Section */
        .about-section {
            padding: 5rem 0;
            background-color: white;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .about-content h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: var(--dark-text);
        }

        .about-content p {
            margin-bottom: 1.5rem;
            color: #4b5563;
        }

        .about-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Mission Section */
        .mission-section {
            padding: 5rem 0;
            background-color: var(--light-bg);
        }

        .mission-content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .mission-content h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .mission-content p {
            margin-bottom: 2rem;
            color: #4b5563;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .value-card {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .value-icon {
            width: 60px;
            height: 60px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.5rem;
        }

        .value-card h3 {
            margin-bottom: 1rem;
            color: var(--dark-text);
        }

        .value-card p {
            color: #6b7280;
        }

        /* Team Section */
        .team-section {
            padding: 5rem 0;
            background-color: white;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        .section-subtitle {
            text-align: center;
            color: #6b7280;
            max-width: 700px;
            margin: 0 auto 3rem;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .team-member {
            text-align: center;
            background-color: var(--light-bg);
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .member-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .member-info {
            padding: 1.5rem;
        }

        .member-info h3 {
            margin-bottom: 0.5rem;
            color: var(--dark-text);
        }

        .member-position {
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 1rem;
            display: block;
        }

        .member-social {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .member-social a {
            width: 36px;
            height: 36px;
            background-color: #e5e7eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark-text);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .member-social a:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Stats Section */
        .stats-section {
            padding: 5rem 0;
            background-color: var(--primary-color);
            color: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: center;
        }

        .stat-item h3 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .stat-item p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Timeline Section */
        .timeline-section {
            padding: 5rem 0;
            background-color: var(--light-bg);
        }

        .timeline {
            position: relative;
            max-width: 700px;
            margin: 4rem auto 0;
        }

        .timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: var(--primary-color);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }

        .timeline-item {
            padding: 10px 40px;
            position: relative;
            width: 50%;
            box-sizing: border-box;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            right: -12px;
            background-color: white;
            border: 4px solid var(--primary-color);
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }

        .left {
            left: 0;
        }

        .right {
            left: 50%;
        }

        .right::after {
            left: -12px;
        }

        .timeline-content {
            padding: 20px;
            background-color: white;
            position: relative;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .timeline-date {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .timeline-content h3 {
            margin-bottom: 10px;
        }

        .timeline-content p {
            color: #6b7280;
        }

        /* CTA Section */
        .cta-section {
            padding: 5rem 0;
            background: linear-gradient(to right, rgba(79, 70, 229, 0.9), rgba(99, 102, 241, 0.8)), url('/api/placeholder/1200/400') no-repeat center center/cover;
            color: white;
            text-align: center;
        }

        .cta-content {
            max-width: 700px;
            margin: 0 auto;
        }

        .cta-content h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .cta-content p {
            margin-bottom: 2rem;
        }

        .btn-white {
            background-color: white;
            color: var(--primary-color);
            padding: 0.8rem 2rem;
            border-radius: 5px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-white:hover {
            background-color: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
        }

        /* Footer */
        footer {
            background-color: #1f2937;
            color: white;
            padding: 3rem 0 1rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-column h3 {
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: #d1d5db;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            background-color: rgba(255, 255, 255, 0.1);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            text-align: center;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem 0;
            }

            .nav-links {
                margin: 1rem 0;
                flex-direction: column;
                align-items: center;
            }

            .nav-links li {
                margin: 0.5rem 0;
            }

            .auth-buttons {
                margin-top: 1rem;
            }

            .about-grid {
                grid-template-columns: 1fr;
            }

            .about-image-container {
                order: -1;
                text-align: center;
            }

            .about-image {
                max-width: 80%;
            }

            .timeline::after {
                left: 31px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            .timeline-item::after {
                left: 18px;
            }

            .left::after, .right::after {
                left: 18px;
            }

            .right {
                left: 0%;
            }
        }
    </style>



    <section class="about-hero">
        <div class="container">
            <div class="about-hero-content">
                <h1>À propos de TGEvent</h1>
                <p>Découvrez notre histoire, notre mission et l'équipe qui rend tout cela possible</p>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="about-grid">
                <div class="about-content">
                    <h2>Notre histoire</h2>
                    <p>TGFEvent est né de la passion pour les événements et de l'envie de faciliter leur organisation. Lancé en 2022, notre plateforme a été créée par une équipe d'entrepreneurs passionnés qui avaient identifié un besoin sur le marché : une solution complète pour gérer et vendre des événements de manière simple et efficace.</p>
                    <p>Après deux années de développement intensif et une phase bêta avec plus de 100 organisateurs d'événements, nous avons officiellement lancé notre plateforme au public en 2024. Depuis, nous avons aidé des milliers d'organisateurs à créer et promouvoir leurs événements, et des millions de participants à découvrir des expériences inoubliables.</p>
                    <p>Aujourd'hui, TGEvent est devenu une référence dans le secteur événementiel, avec une présence dans plus de 15 pays et une équipe internationale dédiée à l'amélioration continue de notre plateforme.</p>
                </div>
                <div class="about-image-container">
                    <img src="https://tse1.mm.bing.net/th/id/OIP.iSH1GH7YU3JH1BZjr4JipgHaE7?r=0&rs=1&pid=ImgDetMain&o=7&rm=3" alt="L'équipe EventMaster" class="about-image">
                </div>
            </div>
        </div>
    </section>

    <section class="mission-section">
        <div class="container">
            <div class="mission-content">
                <h2>Notre mission et nos valeurs</h2>
                <p>Chez TGEvent, nous avons pour mission de connecter les personnes à travers des expériences mémorables et de permettre aux créateurs d'événements de réaliser leurs visions. Nous croyons que les événements ont le pouvoir de transformer les vies, de renforcer les communautés et de créer des souvenirs durables.</p>

                <div class="values-grid">
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3>Accessibilité</h3>
                        <p>Nous nous efforçons de rendre la création et la participation à des événements accessible à tous, quels que soient leur expérience ou leur budget.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3>Innovation</h3>
                        <p>Nous repoussons constamment les limites pour développer des solutions créatives qui répondent aux besoins changeants de l'industrie événementielle.</p>
                    </div>
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Communauté</h3>
                        <p>Nous croyons au pouvoir des événements pour créer et renforcer les liens sociaux et favoriser le sentiment d'appartenance.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="team-section">
        <div class="container">
            <h2 class="section-title">Notre équipe</h2>
            <p class="section-subtitle">Rencontrez les personnes passionnées qui travaillent chaque jour pour rendre votre expérience exceptionnelle.</p>

            <div class="team-grid">
                <div class="team-member">
                    <img src="https://th.bing.com/th/id/OIP.TbdtUnyTZb4WUJyJQcj-DwHaE7?w=247&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Sophie Martin" class="member-img">
                    <div class="member-info">
                        <h3>Sophie Martin</h3>
                        <span class="member-position">Fondatrice & CEO</span>
                        <p>Passionnée d'événementiel depuis plus de 15 ans, Sophie a fondé TGEvent avec la vision de démocratiser l'organisation d'événements.</p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-member">
                    <img src="https://th.bing.com/th/id/OIP.h_P_BaI4xWiXBGp97X1XKwHaE8?w=266&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Thomas Dubois" class="member-img">
                    <div class="member-info">
                        <h3>Thomas Dubois</h3>
                        <span class="member-position">Directeur Technique</span>
                        <p>Ingénieur de formation, Thomas supervise toute la partie technique de la plateforme pour garantir performance et innovation.</p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-member">
                    <img src="https://th.bing.com/th/id/OIP.QVjcw9ZDkdGNyvHE0YRkjAHaE-?w=301&h=201&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Léa Bernard" class="member-img">
                    <div class="member-info">
                        <h3>Léa Bernard</h3>
                        <span class="member-position">Directrice Marketing</span>
                        <p>Avec son expertise en marketing digital, Léa développe des stratégies innovantes pour faire grandir la communauté TGEvent.</p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="team-member">
                    <img src="https://th.bing.com/th/id/OIP.cS4fMVkFBY1ti3dGKF9_zAHaE8?w=260&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Alexandre Petit" class="member-img">
                    <div class="member-info">
                        <h3>Alexandre Petit</h3>
                        <span class="member-position">Responsable Client</span>
                        <p>Alexandre et son équipe veillent à ce que chaque organisateur et participant bénéficie d'un support exceptionnel.</p>
                        <div class="member-social">
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>1M+</h3>
                    <p>Utilisateurs actifs</p>
                </div>
                <div class="stat-item">
                    <h3>50K+</h3>
                    <p>Événements créés</p>
                </div>
                <div class="stat-item">
                    <h3>15+</h3>
                    <p>Pays desservis</p>
                </div>
                <div class="stat-item">
                    <h3>98%</h3>
                    <p>Taux de satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    <section class="timeline-section">
        <div class="container">
            <h2 class="section-title">Notre parcours</h2>
            <p class="section-subtitle">Découvrez les moments clés de notre histoire depuis notre création</p>

            <div class="timeline">
                <div class="timeline-item left">
                    <div class="timeline-content">
                        <span class="timeline-date">Janvier 2022</span>
                        <h3>La naissance deTGEvent</h3>
                        <p>Création de la startup et début du développement de la plateforme avec une équipe de 5 personnes.</p>
                    </div>
                </div>
                <div class="timeline-item right">
                    <div class="timeline-content">
                        <span class="timeline-date">Septembre 2022</span>
                        <h3>Premier tour de financement</h3>
                        <p>Levée de fonds de 2 millions d'euros pour accélérer le développement de notre plateforme.</p>
                    </div>
                </div>
                <div class="timeline-item left">
                    <div class="timeline-content">
                        <span class="timeline-date">Mars 2023</span>
                        <h3>Lancement de la version bêta</h3>
                        <p>100 organisateurs d'événements testent et contribuent à l'amélioration de notre solution.</p>
                    </div>
                </div>
                <div class="timeline-item right">
                    <div class="timeline-content">
                        <span class="timeline-date">Janvier 2024</span>
                        <h3>Lancement officiel</h3>
                        <p>Mise en ligne de la plateforme au public avec plus de 5000 événements dès le premier mois.</p>
                    </div>
                </div>
                <div class="timeline-item left">
                    <div class="timeline-content">
                        <span class="timeline-date">Juin 2024</span>
                        <h3>Expansion internationale</h3>
                        <p>Ouverture de bureaux dans 5 nouveaux pays et traduction de la plateforme en 8 langues.</p>
                    </div>
                </div>
                <div class="timeline-item right">
                    <div class="timeline-content">
                        <span class="timeline-date">Avril 2025</span>
                        <h3>1 million d'utilisateurs</h3>
                        <p>Nous atteignons le million d'utilisateurs actifs et lançons de nouvelles fonctionnalités innovantes.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Rejoignez l'aventure TGEvent</h2>
                <p>Que vous soyez un organisateur cherchant à créer des événements exceptionnels ou un participant à la recherche d'expériences mémorables, TGEvent est là pour vous.</p>
                <a href="#" class="btn-white">Créer mon compte</a>
            </div>
        </div>
    </section>


@endsection

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Inscription</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles (Identical to Login) -->
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1e40af;
            --secondary-color: #64748b;
            --bg-gradient-start: #f8fafc;
            --bg-gradient-end: #e2e8f0;
            --card-bg: rgba(255, 255, 255, 0.9);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow-x: hidden;
            position: relative;
            padding: 2rem 0; 
        }

        .auth-bg-shape {
            position: absolute;
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            z-index: -1;
            animation: pulse 10s infinite alternate;
        }

        .shape-1 {
            width: 500px;
            height: 500px;
            top: -100px;
            right: -100px;
        }

        .shape-2 {
            width: 400px;
            height: 400px;
            bottom: -100px;
            left: -100px;
            background: linear-gradient(45deg, #f43f5e, #fbbf24);
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        .card-glass {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.05);
            border-radius: 24px;
        }

        .logo-mark {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-bottom: 24px;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
        }

        .form-floating > .form-control {
            border: 2px solid #f1f5f9;
            border-radius: 12px;
            background-color: #f8fafc;
            height: 3.5rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-floating > .form-control:focus {
            border-color: var(--primary-color);
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .form-floating > label {
            color: #94a3b8;
            padding-top: 0.8rem;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
            color: white;
        }

        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            margin-top: 0.15em;
            border: 2px solid #cbd5e1;
            border-radius: 6px;
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .auth-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .auth-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Background Shapes -->
    <div class="auth-bg-shape shape-1"></div>
    <div class="auth-bg-shape shape-2"></div>

    <div class="container">
        <div class="row min-vh-100 align-items-center justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card card-glass border-0 p-4 p-sm-5">
                    
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="logo-mark">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-2">Créer un compte</h3>
                        <p class="text-secondary mb-4">Rejoignez-nous en quelques clics</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                        id="nom" name="nom" value="{{ old('nom') }}" placeholder="Nom" required>
                                    <label for="nom">Nom</label>
                                    @error('nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                                        id="prenom" name="prenom" value="{{ old('prenom') }}" placeholder="Prénom" required>
                                    <label for="prenom">Prénom(s)</label>
                                    @error('prenom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                        id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                    <label for="email">E-mail</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                        id="phone" name="phone" value="{{ old('phone') }}" placeholder="Téléphone" required>
                                    <label for="phone">Téléphone</label>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                        id="password" name="password" placeholder="Mot de passe" required>
                                    <label for="password">Mot de passe</label>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" 
                                        id="password_confirmation" name="password_confirmation" placeholder="Confirmer" required>
                                    <label for="password_confirmation">Confirmer</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label text-secondary small" for="terms">
                                J'accepte les <a href="#" class="auth-link">conditions d'utilisation</a>
                            </label>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary-custom">
                                S'inscrire
                            </button>
                        </div>

                        <div class="text-center">
                            <span class="text-secondary small">Déjà inscrit ?</span>
                            <a href="{{ route('login') }}" class="auth-link small ms-1">
                                Se connecter
                            </a>
                        </div>
                    </form>
                </div>
                
                <div class="text-center mt-4">
                    <small class="text-muted opacity-50">&copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</small>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Connexion</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
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
            <div class="col-12 col-md-8 col-lg-5 col-xl-4">
                <div class="card card-glass border-0 p-4 p-sm-5">
                    
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="logo-mark">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-2">Bon retour</h3>
                        <p class="text-secondary mb-4">Connectez-vous à votre espace</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                            <label for="email">Adresse Email</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                id="password" name="password" placeholder="Password" required>
                            <label for="password">Mot de passe</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-secondary small user-select-none" for="remember">
                                    Se souvenir
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="auth-link small">
                                    Oublié ?
                                </a>
                            @endif
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary-custom">
                                Se connecter
                            </button>
                        </div>

                        <div class="text-center">
                            <span class="text-secondary small">Pas de compte ?</span>
                            <a href="{{ route('register') }}" class="auth-link small ms-1">
                                Créer un compte
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
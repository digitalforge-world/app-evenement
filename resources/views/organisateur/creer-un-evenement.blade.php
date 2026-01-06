@extends('layouts.Obase')
@section('title', '| Ajouter un événement')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-3 drop-shadow-lg">
                Créer un événement
            </h1>
            <p class="text-white/80 text-lg">
                Remplissez le formulaire pour créer votre événement
            </p>
        </div>

        <!-- Messages d'erreur et de succès -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-lg">
                {{ session('success') }}
                <button type="button" class="float-right text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">
                    ×
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-lg">
                {{ session('error') }}
                <button type="button" class="float-right text-red-700 hover:text-red-900" onclick="this.parentElement.remove()">
                    ×
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-lg">
                <h6 class="font-semibold mb-2">Veuillez corriger les erreurs suivantes :</h6>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire principal -->
        <form action="{{ route('organisateur.evenement_valider') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf

            <div class="bg-white/95 backdrop-blur-sm shadow-xl rounded-2xl overflow-hidden">
                <div class="p-6 md:p-8">

                    <!-- Section 1: Informations de base -->
                    <div class="mb-8">
                        <h4 class="text-xl font-bold text-indigo-600 mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Informations de base
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Catégorie <span class="text-red-500">*</span>
                                </label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('categorie') border-red-500 @enderror" name="categorie" required>
                                    <option disabled selected>Choisir une catégorie</option>
                                    <option value="conference et congrès" {{ old('categorie') == 'conference et congrès' ? 'selected' : '' }}>Conférence et congrès</option>
                                    <option value="vie nocturne" {{ old('categorie') == 'vie nocturne' ? 'selected' : '' }}>Vie nocturne</option>
                                    <option value="évènement sportive" {{ old('categorie') == 'évènement sportive' ? 'selected' : '' }}>Événement sportif</option>
                                    <option value="fête" {{ old('categorie') == 'fête' ? 'selected' : '' }}>Fête</option>
                                    <option value="concert et festivals de musique" {{ old('categorie') == 'concert et festivals de musique' ? 'selected' : '' }}>Concerts et festivals</option>
                                    <option value="santé" {{ old('categorie') == 'santé' ? 'selected' : '' }}>Santé</option>
                                    <option value="voyage et tourisme" {{ old('categorie') == 'voyage et tourisme' ? 'selected' : '' }}>Voyage et tourisme</option>
                                </select>
                                @error('categorie')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Titre de l'événement <span class="text-red-500">*</span>
                                </label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('titre') border-red-500 @enderror" name="titre" value="{{ old('titre') }}" placeholder="Nom de votre événement" required>
                                @error('titre')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('date') border-red-500 @enderror" name="date" value="{{ old('date') }}" required>
                                @error('date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Heure début <span class="text-red-500">*</span>
                                </label>
                                <input type="time" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('start_heure') border-red-500 @enderror" name="start_heure" value="{{ old('start_heure') }}" required>
                                @error('start_heure')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Heure fin <span class="text-red-500">*</span>
                                </label>
                                <input type="time" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('end_heure') border-red-500 @enderror" name="end_heure" value="{{ old('end_heure') }}" required>
                                @error('end_heure')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200 my-8">

                    <!-- Section 2: Lieu et médias -->
                    <div class="mb-8">
                        <h4 class="text-xl font-bold text-indigo-600 mb-4 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            Lieu et médias
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Lieu <span class="text-red-500">*</span>
                                </label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('lieu') border-red-500 @enderror" name="lieu" value="{{ old('lieu') }}" placeholder="Adresse du lieu" required>
                                @error('lieu')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Google Maps (optionnel)
                                </label>
                                <input type="url" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('lien_google_map') border-red-500 @enderror" name="lien_google_map" value="{{ old('lien_google_map') }}" placeholder="Lien Google Maps">
                                @error('lien_google_map')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Photo de l'événement <span class="text-red-500">*</span>
                                </label>
                                <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('photo') border-red-500 @enderror" name="photo" accept="image/*" required>
                                <p class="text-sm text-gray-500 mt-1">Formats acceptés: JPEG, PNG, JPG, GIF, SVG (Max: 10MB)</p>
                                @error('photo')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Vidéo (optionnel)
                                </label>
                                <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('video') border-red-500 @enderror" name="video" accept="video/*">
                                <p class="text-sm text-gray-500 mt-1">Formats acceptés: MP4, MOV, OGG, QT (Max: 100MB)</p>
                                @error('video')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200 my-8">

                    <!-- Section 3: Organisateur -->
                    <div class="mb-8">
                        <h4 class="text-xl font-bold text-indigo-600 mb-4 flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Informations organisateur
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nom et prénom <span class="text-red-500">*</span>
                                </label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('nom_proprietaire') border-red-500 @enderror" name="nom_proprietaire" value="{{ old('nom_proprietaire') }}" placeholder="Votre nom complet" required>
                                @error('nom_proprietaire')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Téléphone
                                </label>
                                <input type="tel" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('telephone') border-red-500 @enderror" name="telephone" value="{{ old('telephone') }}" placeholder="Numéro de téléphone">
                                @error('telephone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Email
                                </label>
                                <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" placeholder="Adresse email">
                                @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200 my-8">

                    <!-- Section 4: Réseaux sociaux -->
                    <div class="mb-8">
                        <h4 class="text-xl font-bold text-indigo-600 mb-4 flex items-center">
                            <i class="fas fa-share-alt mr-2"></i>
                            Réseaux sociaux (optionnel)
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Facebook
                                </label>
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 rounded-l-lg border-l border-t border-b border-gray-300 bg-blue-500 text-white">
                                        <i class="fab fa-facebook"></i>
                                    </span>
                                    <input type="url" class="flex-1 px-3 py-2 border border-gray-300 rounded-r-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('facebook') border-red-500 @enderror" name="facebook" value="{{ old('facebook') }}" placeholder="Lien Facebook">
                                </div>
                                @error('facebook')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    WhatsApp
                                </label>
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 rounded-l-lg border-l border-t border-b border-gray-300 bg-green-500 text-white">
                                        <i class="fab fa-whatsapp"></i>
                                    </span>
                                    <input type="text" class="flex-1 px-3 py-2 border border-gray-300 rounded-r-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('whatsapp') border-red-500 @enderror" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="Lien WhatsApp">
                                </div>
                                @error('whatsapp')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Twitter
                                </label>
                                <div class="flex">
                                    <span class="inline-flex items-center px-3 rounded-l-lg border-l border-t border-b border-gray-300 bg-blue-400 text-white">
                                        <i class="fab fa-twitter"></i>
                                    </span>
                                    <input type="url" class="flex-1 px-3 py-2 border border-gray-300 rounded-r-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('twitter') border-red-500 @enderror" name="twitter" value="{{ old('twitter') }}" placeholder="Lien Twitter">
                                </div>
                                @error('twitter')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200 my-8">

                    <!-- Section 5: Description et statut -->
                    <div class="mb-8">
                        <h4 class="text-xl font-bold text-indigo-600 mb-4 flex items-center">
                            <i class="fas fa-align-left mr-2"></i>
                            Description et publication
                        </h4>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Description de l'événement
                            </label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror" name="description" rows="6" placeholder="Décrivez votre événement en détail...">{{ old('description') }}</textarea>
                            @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-4">
                                Statut de publication <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <div class="border border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:bg-gray-50 status-card">
                                        <input type="radio" class="mb-2" name="statut" id="statut1" value="en organisation" {{ old('statut', 'en organisation') == 'en organisation' ? 'checked' : '' }} required>
                                        <label class="cursor-pointer" for="statut1">
                                            <i class="fas fa-edit text-yellow-500 text-2xl mb-2 block"></i>
                                            <strong class="block">Brouillon</strong>
                                            <p class="text-gray-600 text-sm">Compléter plus tard</p>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <div class="border border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:bg-gray-50 status-card">
                                        <input type="radio" class="mb-2" name="statut" id="statut2" value="publier" {{ old('statut') == 'publier' ? 'checked' : '' }} required>
                                        <label class="cursor-pointer" for="statut2">
                                            <i class="fas fa-globe text-green-500 text-2xl mb-2 block"></i>
                                            <strong class="block">Publier</strong>
                                            <p class="text-gray-600 text-sm">Visible immédiatement</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @error('statut')<p class="text-red-500 text-sm mt-2">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="text-center pt-6 border-t border-gray-200">
                        <button type="submit" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
                            <i class="fas fa-save mr-2"></i>
                            Créer l'événement
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.querySelector('.needs-validation');

    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();

            const firstInvalid = form.querySelector(':invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus();
            }
        }
        form.classList.add('was-validated');
    });

    // Time validation
    const startTime = document.querySelector('[name="start_heure"]');
    const endTime = document.querySelector('[name="end_heure"]');

    function validateTimes() {
        if (startTime.value && endTime.value && startTime.value >= endTime.value) {
            endTime.setCustomValidity('L\'heure de fin doit être après l\'heure de début');
        } else {
            endTime.setCustomValidity('');
        }
    }

    startTime.addEventListener('change', validateTimes);
    endTime.addEventListener('change', validateTimes);

    // Date minimum (tomorrow)
    const dateInput = document.querySelector('[name="date"]');
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    dateInput.min = tomorrow.toISOString().split('T')[0];

    // Radio card selection
    const statusCards = document.querySelectorAll('.status-card');
    statusCards.forEach(card => {
        const radio = card.querySelector('input[type="radio"]');

        card.addEventListener('click', function() {
            radio.checked = true;
            updateRadioCards();
        });

        radio.addEventListener('change', updateRadioCards);
    });

    function updateRadioCards() {
        statusCards.forEach(card => {
            const radio = card.querySelector('input[type="radio"]');
            if (radio.checked) {
                card.classList.add('border-indigo-500', 'bg-indigo-50');
            } else {
                card.classList.remove('border-indigo-500', 'bg-indigo-50');
            }
        });
    }

    updateRadioCards(); // Initial state

    // File size validation
    const photoInput = document.querySelector('[name="photo"]');
    const videoInput = document.querySelector('[name="video"]');

    if (photoInput) {
        photoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file && file.size > 10 * 1024 * 1024) {
                alert('La photo ne doit pas dépasser 10 Mo');
                this.value = '';
            }
        });
    }

    if (videoInput) {
        videoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file && file.size > 100 * 1024 * 1024) {
                alert('La vidéo ne doit pas dépasser 100 Mo');
                this.value = '';
            }
        });
    }

    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
});
</script>

@endsection

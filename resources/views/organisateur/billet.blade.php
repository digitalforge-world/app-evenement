@extends('layouts.Obase')
@section('title', '| Création de billets')
@section('content')

<div class="container mx-auto px-4 py-8 max-w-7xl">
    <div class="flex justify-center">
        <div class="w-full max-w-6xl">
            <!-- Titre de la page avec animation -->
            <div class="text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-bold text-purple-700 mb-6">Création de billets</h1>
                <div class="flex items-center justify-center mb-4">
                    <div class="flex-1 max-w-28 h-1 bg-purple-700 rounded-full"></div>
                    <div class="mx-4 text-purple-700 text-3xl">
                        <i class="bi bi-ticket-perforated"></i>
                    </div>
                    <div class="flex-1 max-w-28 h-1 bg-purple-700 rounded-full"></div>
                </div>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Créez des billets pour vos événements et gérez vos ventes facilement</p>
            </div>

            <!-- Notification de succès -->
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill mr-2 text-green-600"></i>
                    {{ session('success') }}
                    <button type="button" class="ml-auto text-green-600 hover:text-green-800" onclick="this.parentElement.style.display='none'">
                        <i class="bi bi-x text-xl"></i>
                    </button>
                </div>
            @endif

            <!-- Carte principale -->
            <div class="bg-white shadow-2xl rounded-2xl overflow-hidden mb-8">
                <div class="grid lg:grid-cols-12 gap-0">
                    <!-- Image latérale - cachée sur mobile -->
                    <div class="hidden lg:block lg:col-span-5">
                        <div class="relative h-full min-h-96">
                            <img src="{{ asset('asset/image/ticket.jpg') }}" class="w-full h-full object-cover" alt="Création de billets">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-purple-700/30 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 p-6 text-white">
                                <h3 class="text-xl font-bold mb-2">Gérez vos billets</h3>
                                <p class="text-gray-200">Définissez différents types de billets pour maximiser vos ventes</p>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire -->
                    <div class="lg:col-span-7">
                        <div class="p-6 md:p-8 lg:p-10">
                            <form action="{{ route('organisateur.valide-billet') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Sélection de l'événement -->
                                    <div class="space-y-2">
                                        <label for="evenement" class="block text-sm font-medium text-gray-700">Événement</label>
                                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white transition-colors" id="evenement" name="evenement_id" required>
                                            <option value="" disabled selected>Choisir un événement</option>
                                            @foreach ($evenementid as $event)
                                                <option value="{{ $event->id }}">{{ $event->titre }}</option>
                                            @endforeach
                                        </select>
                                        @error('evenement_id')
                                            <div class="text-red-600 text-sm flex items-center mt-1">
                                                <i class="bi bi-exclamation-circle mr-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Type de billet -->
                                    <div class="space-y-2">
                                        <label for="type-billet" class="block text-sm font-medium text-gray-700">Type de billet</label>
                                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors" id="type-billet" name="type" value="{{ old('type') }}" placeholder="Ex: VIP, Standard" required>
                                        @error('type')
                                            <div class="text-red-600 text-sm flex items-center mt-1">
                                                <i class="bi bi-exclamation-circle mr-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Quantité -->
                                    <div class="space-y-2">
                                        <label for="quantite" class="block text-sm font-medium text-gray-700">Quantité disponible</label>
                                        <input type="number" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors" id="quantite" name="quantite" min="1" value="{{ old('quantite') ?? 1 }}" placeholder="Nombre de billets disponibles" required>
                                        @error('quantite')
                                            <div class="text-red-600 text-sm flex items-center mt-1">
                                                <i class="bi bi-exclamation-circle mr-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Prix -->
                                    <div class="space-y-2">
                                        <label for="prix" class="block text-sm font-medium text-gray-700">Prix (Fcfa)</label>
                                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors" id="prix" name="prix" value="{{ old('prix') }}" placeholder="Prix en Fcfa" required>
                                        @error('prix')
                                            <div class="text-red-600 text-sm flex items-center mt-1">
                                                <i class="bi bi-exclamation-circle mr-1"></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Bouton de soumission -->
                                    <div class="md:col-span-2 mt-6">
                                        <button type="submit" class="w-full bg-purple-700 hover:bg-purple-800 focus:bg-purple-800 text-white font-semibold py-4 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                                            <i class="bi bi-save mr-2"></i> Créer le billet
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section informative mobile -->
            <div class="lg:hidden bg-gradient-to-br from-purple-700 to-purple-800 text-white p-6 rounded-2xl mb-6">
                <div class="text-center">
                    <i class="bi bi-ticket-perforated text-4xl mb-3"></i>
                    <h3 class="text-xl font-bold mb-2">Gérez vos billets efficacement</h3>
                    <p class="text-purple-100">Définissez différents types de billets pour maximiser vos ventes et offrir plus d'options à vos participants.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Validation des formulaires Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('.needs-validation');

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                // Ajout de classes Tailwind pour la validation
                const inputs = form.querySelectorAll('input[required], select[required]');
                inputs.forEach(input => {
                    if (!input.checkValidity()) {
                        input.classList.add('border-red-500', 'ring-red-500');
                        input.classList.remove('border-gray-300');
                    } else {
                        input.classList.add('border-green-500', 'ring-green-500');
                        input.classList.remove('border-gray-300', 'border-red-500', 'ring-red-500');
                    }
                });
            }, false);
        });

        // Validation en temps réel
        const inputs = document.querySelectorAll('input[required], select[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.checkValidity()) {
                    this.classList.remove('border-red-500', 'ring-red-500');
                    this.classList.add('border-green-500');
                } else {
                    this.classList.remove('border-green-500');
                    this.classList.add('border-red-500');
                }
            });

            input.addEventListener('input', function() {
                if (this.classList.contains('border-red-500') && this.checkValidity()) {
                    this.classList.remove('border-red-500', 'ring-red-500');
                    this.classList.add('border-green-500');
                }
            });
        });
    });
</script>

@endsection

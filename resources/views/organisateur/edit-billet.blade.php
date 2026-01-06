@extends('layouts.Obase')
@section('title', '| Modifier le Billet')
@section('content')

<div class="container mx-auto px-4 py-8 max-w-4xl">
    <!-- Bouton retour -->
    <div class="mb-6">
        <a href="{{ route('organisateur.event-detail-billets', $billet->evenement_id) }}"
           class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium">
            <i class="bi bi-arrow-left mr-2"></i> Retour aux détails de l'événement
        </a>
    </div>

    <!-- En-tête -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">
            <i class="bi bi-pencil-square text-purple-600 mr-2"></i>
            Modifier le Billet
        </h1>
        <p class="text-gray-600">Modifiez les informations du billet "{{ $billet->type }}"</p>
    </div>

    <!-- Messages de succès/erreur -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 rounded-lg p-4 mb-6 flex items-center">
            <i class="bi bi-check-circle-fill text-2xl mr-3"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg p-4 mb-6 flex items-center">
            <i class="bi bi-exclamation-circle-fill text-2xl mr-3"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <i class="bi bi-exclamation-triangle-fill text-2xl mr-3 mt-1"></i>
                <div>
                    <p class="font-semibold mb-2">Erreurs de validation :</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Informations sur le billet actuel -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <i class="bi bi-info-circle-fill text-blue-600 text-2xl mr-3 mt-1"></i>
            <div class="flex-1">
                <p class="font-semibold text-blue-900 mb-2">Informations importantes :</p>
                <ul class="space-y-1 text-blue-800 text-sm">
                    <li>• <strong>{{ $billet->quantite_vendue }}</strong> billet(s) ont déjà été vendus</li>
                    <li>• La quantité totale ne peut pas être inférieure au nombre de billets vendus</li>
                    <li>• Si vous augmentez la quantité, les nouveaux billets seront disponibles immédiatement</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Formulaire de modification -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <i class="bi bi-ticket-perforated-fill mr-3"></i>
                Formulaire de Modification
            </h2>
        </div>

        <form action="{{ route('organisateur.update-billet', $billet->id) }}"
              method="POST"
              class="p-8">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Événement associé -->
                <div>
                    <label for="evenement_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="bi bi-calendar-event text-purple-600 mr-1"></i>
                        Événement *
                    </label>
                    <select name="evenement_id"
                            id="evenement_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                            required>
                        <option value="">Sélectionnez un événement</option>
                        @foreach($evenements as $evenement)
                            <option value="{{ $evenement->id }}"
                                    {{ $billet->evenement_id == $evenement->id ? 'selected' : '' }}>
                                {{ $evenement->titre }} - {{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}
                            </option>
                        @endforeach
                    </select>
                    @error('evenement_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Type de billet -->
                <div>
                    <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="bi bi-tag text-purple-600 mr-1"></i>
                        Type de Billet *
                    </label>
                    <input type="text"
                           name="type"
                           id="type"
                           value="{{ old('type', $billet->type) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                           placeholder="Ex: VIP, STANDARD, EARLY BIRD..."
                           required>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        <i class="bi bi-lightbulb mr-1"></i>
                        Exemples : VIP, STANDARD, EARLY BIRD, GRATUIT, etc.
                    </p>
                </div>

                <!-- Prix -->
                <div>
                    <label for="prix" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="bi bi-cash-stack text-purple-600 mr-1"></i>
                        Prix (FCFA) *
                    </label>
                    <input type="number"
                           name="prix"
                           id="prix"
                           value="{{ old('prix', $billet->prix) }}"
                           min="0"
                           step="1"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                           placeholder="0"
                           required>
                    @error('prix')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        <i class="bi bi-info-circle mr-1"></i>
                        Prix actuel : <strong>{{ number_format($billet->prix) }} FCFA</strong>
                    </p>
                </div>

                <!-- Quantité -->
                <div>
                    <label for="quantite" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="bi bi-box-seam text-purple-600 mr-1"></i>
                        Quantité Totale *
                    </label>
                    <input type="number"
                           name="quantite"
                           id="quantite"
                           value="{{ old('quantite', $billet->quantite_totale) }}"
                           min="{{ $billet->quantite_vendue }}"
                           step="1"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                           required>
                    @error('quantite')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Statistiques actuelles -->
                    <div class="mt-3 grid grid-cols-3 gap-3">
                        <div class="bg-gray-50 rounded-lg p-3 text-center">
                            <p class="text-xs text-gray-600 mb-1">Actuel</p>
                            <p class="text-lg font-bold text-gray-800">{{ number_format($billet->quantite_totale) }}</p>
                        </div>
                        <div class="bg-green-50 rounded-lg p-3 text-center">
                            <p class="text-xs text-green-600 mb-1">Vendus</p>
                            <p class="text-lg font-bold text-green-700">{{ number_format($billet->quantite_vendue) }}</p>
                        </div>
                        <div class="bg-orange-50 rounded-lg p-3 text-center">
                            <p class="text-xs text-orange-600 mb-1">Disponibles</p>
                            <p class="text-lg font-bold text-orange-700">{{ number_format($billet->quantite_disponible) }}</p>
                        </div>
                    </div>

                    <p class="mt-2 text-sm text-gray-500">
                        <i class="bi bi-exclamation-triangle mr-1"></i>
                        La quantité minimale autorisée est <strong>{{ number_format($billet->quantite_vendue) }}</strong> (nombre de billets déjà vendus)
                    </p>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="mt-8 flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('organisateur.event-detail-billets', $billet->evenement_id) }}"
                   class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition-colors">
                    <i class="bi bi-x-circle mr-2"></i>
                    Annuler
                </a>

                <button type="submit"
                        class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <i class="bi bi-check-circle-fill mr-2"></i>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>

    <!-- Aperçu en temps réel -->
    <div class="mt-6 bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">
            <i class="bi bi-eye text-purple-600 mr-2"></i>
            Aperçu des modifications
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600 mb-1">Avant modification</p>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="font-semibold text-gray-800">{{ $billet->type }}</p>
                    <p class="text-purple-600 font-bold">{{ number_format($billet->prix) }} FCFA</p>
                    <p class="text-sm text-gray-600">Quantité: {{ number_format($billet->quantite_totale) }}</p>
                </div>
            </div>

            <div>
                <p class="text-sm text-gray-600 mb-1">Après modification (aperçu)</p>
                <div class="bg-purple-50 rounded-lg p-4 border-2 border-purple-200">
                    <p class="font-semibold text-gray-800" id="preview-type">{{ $billet->type }}</p>
                    <p class="text-purple-600 font-bold" id="preview-prix">{{ number_format($billet->prix) }} FCFA</p>
                    <p class="text-sm text-gray-600" id="preview-quantite">Quantité: {{ number_format($billet->quantite_totale) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script pour l'aperçu en temps réel -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeInput = document.getElementById('type');
    const prixInput = document.getElementById('prix');
    const quantiteInput = document.getElementById('quantite');

    const previewType = document.getElementById('preview-type');
    const previewPrix = document.getElementById('preview-prix');
    const previewQuantite = document.getElementById('preview-quantite');

    // Fonction pour formater les nombres
    function formatNumber(num) {
        return new Intl.NumberFormat('fr-FR').format(num);
    }

    // Mise à jour de l'aperçu
    function updatePreview() {
        if (typeInput.value) {
            previewType.textContent = typeInput.value;
        }

        if (prixInput.value) {
            previewPrix.textContent = formatNumber(prixInput.value) + ' FCFA';
        }

        if (quantiteInput.value) {
            previewQuantite.textContent = 'Quantité: ' + formatNumber(quantiteInput.value);
        }
    }

    // Écouter les changements
    typeInput.addEventListener('input', updatePreview);
    prixInput.addEventListener('input', updatePreview);
    quantiteInput.addEventListener('input', updatePreview);
});
</script>

@endsection

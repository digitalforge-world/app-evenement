@extends('layouts.Obase')
@section('title', '| sponsor')
@section('content')
    <div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="container mx-auto max-w-6xl">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Ajouter un Sponsor</h1>
                <p class="text-gray-600">Associez des sponsors à vos événements pour renforcer votre visibilité</p>
            </div>

            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 text-green-800 px-6 py-4 rounded-lg shadow-sm mb-8 flex items-center animate-fade-in">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="flex flex-col lg:flex-row">
                    <!-- Image Section with Overlay -->
                    <div class="lg:w-2/5 relative bg-gradient-to-br from-purple-600 to-indigo-700 p-12 flex flex-col justify-center items-center text-white">
                        <div class="absolute inset-0 bg-black opacity-10"></div>
                        <div class="relative z-10 text-center">
                            <div class="mb-6">
                                <svg class="w-24 h-24 mx-auto mb-4 opacity-90" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold mb-4">Partenaires & Sponsors</h2>
                            <p class="text-purple-100 mb-6 leading-relaxed">Gérez vos partenariats et sponsorings en toute simplicité. Ajoutez des sponsors pour valoriser vos événements.</p>
                            <div class="flex flex-wrap justify-center gap-4 mt-8">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm">Gestion facile</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm">Visibilité accrue</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Section -->
                    <div class="lg:w-3/5 p-8 lg:p-12">
                        <div class="max-w-2xl mx-auto">
                            <form action="{{ route('organisateur.valide-sponsor') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                @csrf

                                <!-- Événement selection -->
                                <div class="space-y-2">
                                    <label for="categorie" class="block text-sm font-semibold text-gray-700">
                                        Événement associé <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <select class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 focus:bg-white transition-all duration-200 appearance-none cursor-pointer"
                                                id="categorie" name="evenement_id">
                                            <option disabled selected>Sélectionnez l'événement à sponsoriser</option>
                                            @foreach ($evenementid as $evenementid)
                                                <option value="{{ $evenementid->id }}">
                                                    {{ $evenementid->titre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    </div>
                                    @error('evenement_id')
                                        <span class="text-red-500 text-sm flex items-center mt-1">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <!-- Nom du sponsor -->
                                <div class="space-y-2">
                                    <label for="nom" class="block text-sm font-semibold text-gray-700">
                                        Nom du sponsor <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nom" 
                                           class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 focus:bg-white transition-all duration-200"
                                           id="nom" 
                                           placeholder="Ex: Entreprise Tech Solutions"
                                           value="{{ old('nom') }}">
                                    @error('nom')
                                        <span class="text-red-500 text-sm flex items-center mt-1">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <!-- Logo upload -->
                                <div class="space-y-2">
                                    <label for="logo" class="block text-sm font-semibold text-gray-700">
                                        Logo du sponsor <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="file" name="logo"
                                               class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 focus:bg-white transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 cursor-pointer"
                                               id="logo" 
                                               accept="image/*"
                                               value="{{ old('logo') }}">
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Formats acceptés: JPG, PNG, SVG (Max: 2MB)</p>
                                    @error('logo')
                                        <span class="text-red-500 text-sm flex items-center mt-1">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <!-- Lien web -->
                                <div class="space-y-2">
                                    <label for="lien_web" class="block text-sm font-semibold text-gray-700">
                                        Site web du sponsor
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <input type="text" name="lien_web"
                                               class="w-full pl-12 pr-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-purple-500 focus:bg-white transition-all duration-200"
                                               id="lien_web" 
                                               placeholder="https://www.exemple.com"
                                               value="{{ old('lien_web') }}">
                                    </div>
                                    @error('lien_web')
                                        <span class="text-red-500 text-sm flex items-center mt-1">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <!-- Submit button -->
                                <div class="pt-6">
                                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-semibold py-4 px-6 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex justify-center items-center group">
                                        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-lg">Enregistrer le sponsor</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-purple-500">
                    <div class="flex items-center mb-3">
                        <div class="bg-purple-100 rounded-full p-3 mr-3">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-800">Partenariats</h3>
                    </div>
                    <p class="text-sm text-gray-600">Créez des relations durables avec vos sponsors</p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-indigo-500">
                    <div class="flex items-center mb-3">
                        <div class="bg-indigo-100 rounded-full p-3 mr-3">
                            <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-800">Visibilité</h3>
                    </div>
                    <p class="text-sm text-gray-600">Augmentez l'exposition de vos événements</p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-pink-500">
                    <div class="flex items-center mb-3">
                        <div class="bg-pink-100 rounded-full p-3 mr-3">
                            <svg class="w-6 h-6 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-800">Qualité</h3>
                    </div>
                    <p class="text-sm text-gray-600">Associez-vous avec les meilleurs partenaires</p>
                </div>
            </div>
        </div>
    </div>
@endsection
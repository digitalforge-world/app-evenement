@extends('layouts.Obase')
@section('title', '| Organisateur - Dashboard')
@section('content')
                <!-- Stats Cards -->
            <div class="p-4 sm:p-6 grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border-l-4 border-blue-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-xs sm:text-sm">Événements à venir</p>
                            <h3 class="text-xl sm:text-2xl font-bold mt-1 sm:mt-2">12</h3>
                        </div>
                        <div class="p-2 sm:p-3 rounded-lg bg-blue-100 text-blue-600">
                            <i data-feather="calendar" class="w-4 h-4 sm:w-6 sm:h-6"></i>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mt-2 sm:mt-4">+2 depuis hier</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border-l-4 border-green-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-xs sm:text-sm">Participants total</p>
                            <h4 class="text-xl  font-bold mt-1 sm:mt-2">4558</h4>
                        </div>
                        <div class="p-2 sm:p-3 rounded-lg bg-green-100 text-green-600">
                            <i data-feather="users" class="w-4 h-4 sm:w-6 sm:h-6"></i>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mt-2 sm:mt-4">+124 cette semaine</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border-l-4 border-yellow-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-xs sm:text-sm">Revenus</p>
                            <h4 class="text-xl sm:text-2xl font-bold mt-1 sm:mt-2">455</h4>
                        </div>
                        <div class="p-2 sm:p-3 rounded-lg bg-yellow-100 text-yellow-600">
                            <i data-feather="dollar-sign" class="w-4 h-4 sm:w-6 sm:h-6"></i>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mt-2 sm:mt-4">+12% ce mois</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 border-l-4 border-purple-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-xs sm:text-sm">Taux de remplissage</p>
                            <h3 class="text-xl sm:text-2xl font-bold mt-1 sm:mt-2">78%</h3>
                        </div>
                        <div class="p-2 sm:p-3 rounded-lg bg-purple-100 text-purple-600">
                            <i data-feather="pie-chart" class="w-4 h-4 sm:w-6 sm:h-6"></i>
                        </div>
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500 mt-2 sm:mt-4">+5% cette semaine</p>
                </div>
            </div>

            <!-- Charts and Recent Events -->
            <div class="px-4 sm:px-6 grid grid-cols-1 xl:grid-cols-3 gap-4 sm:gap-6">
                <!-- Chart -->
                <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6 xl:col-span-2">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 sm:mb-6 space-y-2 sm:space-y-0">
                        <h2 class="text-lg font-semibold text-gray-800">Participation aux événements</h2>
                        <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full sm:w-auto">
                            <option>7 derniers jours</option>
                            <option>30 derniers jours</option>
                            <option>3 derniers mois</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="eventsChart"></canvas>
                    </div>
                </div>

                <!-- Recent Events -->
                <div class="bg-white rounded-xl shadow-sm p-4 sm:p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 sm:mb-6">Événements récents</h2>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-indigo-100 rounded-lg text-indigo-600 flex-shrink-0">
                                <i data-feather="music" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="font-medium text-sm sm:text-base">Concert d'été</h4>
                                <p class="text-xs sm:text-sm text-gray-500">15 Juin 2023</p>
                                <span class="inline-block text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full mt-1">Complet</span>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-blue-100 rounded-lg text-blue-600 flex-shrink-0">
                                <i data-feather="book" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="font-medium text-sm sm:text-base">Conférence Tech</h4>
                                <p class="text-xs sm:text-sm text-gray-500">22 Juin 2023</p>
                                <span class="inline-block text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full mt-1">75% rempli</span>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-purple-100 rounded-lg text-purple-600 flex-shrink-0">
                                <i data-feather="coffee" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="font-medium text-sm sm:text-base">Networking Café</h4>
                                <p class="text-xs sm:text-sm text-gray-500">28 Juin 2023</p>
                                <span class="inline-block text-xs px-2 py-1 bg-red-100 text-red-800 rounded-full mt-1">30% rempli</span>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="p-2 bg-green-100 rounded-lg text-green-600 flex-shrink-0">
                                <i data-feather="film" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="font-medium text-sm sm:text-base">Festival du Film</h4>
                                <p class="text-xs sm:text-sm text-gray-500">5 Juillet 2023</p>
                                <span class="inline-block text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full mt-1">50% rempli</span>
                            </div>
                        </div>
                    </div>
                    <button class="mt-4 w-full py-2 text-sm text-indigo-600 hover:text-indigo-800 font-medium transition-colors">
                        Voir tous les événements
                    </button>
                </div>
            </div>

            <!-- Upcoming Events Table -->
            <div class="p-4 sm:p-6">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-4 sm:p-6 flex flex-col sm:flex-row sm:justify-between sm:items-center border-b border-gray-200 space-y-3 sm:space-y-0">
                        <h2 class="text-lg font-semibold text-gray-800">Événements à venir</h2>
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center justify-center space-x-2 transition-colors">
                            <i data-feather="plus" class="w-4 h-4"></i>
                            <a href="{{ route('organisateur.ajouter-un-evenement') }}">
                        <span>Nouvel événement</span>
                        </a>
                        </button>
                    </div>

                    <div class="table-container">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                    <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Lieu</th>
                                    <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participants</th>
                                    <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Statut</th>
                                    <th scope="col" class="px-4 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-4 sm:px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                                <i data-feather="music" class="text-indigo-600 w-4 h-4 sm:w-5 sm:h-5"></i>
                                            </div>
                                            <div class="ml-3 sm:ml-4 min-w-0">
                                                <div class="text-sm font-medium text-gray-900">Concert d'été</div>
                                                <div class="text-xs sm:text-sm text-gray-500">Musique</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">15 Juin</div>
                                        <div class="text-xs sm:text-sm text-gray-500">20:00</div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                        <div class="text-sm text-gray-900">Parc Central</div>
                                        <div class="text-sm text-gray-500">Paris</div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">500/500</div>
                                        <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                            <div class="bg-green-600 h-1.5 rounded-full" style="width: 100%"></div>
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Complet</span>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-indigo-600 hover:text-indigo-900 mr-2 sm:mr-3"><i data-feather="edit-2" class="w-4 h-4"></i></button>
                                        <button class="text-red-600 hover:text-red-900"><i data-feather="trash-2" class="w-4 h-4"></i></button>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="px-4 sm:px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                                <i data-feather="book" class="text-blue-600 w-4 h-4 sm:w-5 sm:h-5"></i>
                                            </div>
                                            <div class="ml-3 sm:ml-4 min-w-0">
                                                <div class="text-sm font-medium text-gray-900">Conférence Tech</div>
                                                <div class="text-xs sm:text-sm text-gray-500">Technologie</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">22 Juin</div>
                                        <div class="text-xs sm:text-sm text-gray-500">09:00</div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                        <div class="text-sm text-gray-900">Centre des Congrès</div>
                                        <div class="text-sm text-gray-500">Lyon</div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">375/500</div>
                                        <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                            <div class="bg-yellow-500 h-1.5 rounded-full" style="width: 75%"></div>
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En cours</span>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-indigo-600 hover:text-indigo-900 mr-2 sm:mr-3"><i data-feather="edit-2" class="w-4 h-4"></i></button>
                                        <button class="text-red-600 hover:text-red-900"><i data-feather="trash-2" class="w-4 h-4"></i></button>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="px-4 sm:px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8 sm:h-10 sm:w-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                                <i data-feather="coffee" class="text-purple-600 w-4 h-4 sm:w-5 sm:h-5"></i>
                                            </div>
                                            <div class="ml-3 sm:ml-4 min-w-0">
                                                <div class="text-sm font-medium text-gray-900">Networking Café</div>
                                                <div class="text-xs sm:text-sm text-gray-500">Business</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">28 Juin</div>
                                        <div class="text-xs sm:text-sm text-gray-500">18:30</div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                        <div class="text-sm text-gray-900">Le Café Moderne</div>
                                        <div class="text-sm text-gray-500">Marseille</div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">60/200</div>
                                        <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                            <div class="bg-red-500 h-1.5 rounded-full" style="width: 30%"></div>
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden lg:table-cell">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Faible</span>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-indigo-600 hover:text-indigo-900 mr-2 sm:mr-3"><i data-feather="edit-2" class="w-4 h-4"></i></button>
                                        <button class="text-red-600 hover:text-red-900"><i data-feather="trash-2" class="w-4 h-4"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
@endsection

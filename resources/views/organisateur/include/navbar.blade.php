<!-- Sidebar Overlay for Mobile -->
    <div id="sidebarOverlay" class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-40 opacity-0 pointer-events-none lg:hidden"></div>

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div id="sidebar" class="sidebar bg-indigo-800 text-white w-64 fixed h-full z-50 lg:relative lg:translate-x-0">
            <div class="p-4 flex items-center justify-between border-b border-indigo-700">
                <div class="flex items-center space-x-3">
                    <i data-feather="calendar" class="w-8 h-8 text-indigo-300"></i>
                    <span class="text-xl font-semibold">EventManager Pro</span>
                </div>
                <!-- Close button for mobile -->
                <button id="closeSidebar" class="lg:hidden p-1 rounded-md hover:bg-indigo-700">
                    <i data-feather="x" class="w-6 h-6"></i>
                </button>
            </div>

            <nav class="mt-6 px-4 space-y-1">
                <a  href="{{ route('organisateur.dashboard') }}" class="flex items-center space-x-3 bg-indigo-700 rounded-lg px-3 py-3">
                    <i data-feather="home" class="w-5 h-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('organisateur.ajouter-un-evenement') }}" class="flex items-center space-x-3 hover:bg-indigo-700 rounded-lg px-3 py-3 cursor-pointer transition-colors">
                    <i data-feather="calendar" class="w-5 h-5"></i>
                    <span>Ajouter un Événements</span>
                </a>
                <a href="{{ route('organisateur.sponsor-form') }}"  class="flex items-center space-x-3 hover:bg-indigo-700 rounded-lg px-3 py-3 cursor-pointer transition-colors">
                    <i data-feather="users" class="w-5 h-5"></i>
                    <span>Sponsor</span>
                </a>
                <a href="{{ route('organisateur.billet') }}" class="flex items-center space-x-3 hover:bg-indigo-700 rounded-lg px-3 py-3 cursor-pointer transition-colors">
                    <i data-feather="dollar-sign" class="w-5 h-5"></i>
                    <span>Billet</span>
                </a>
                 <a href="{{ route('organisateur.scan-billet') }}" class="flex items-center space-x-3 hover:bg-indigo-700 rounded-lg px-3 py-3 cursor-pointer transition-colors">
                    <i data-feather="dollar-sign" class="w-5 h-5"></i>
                    <span>Scanner Billet</span>
                </a>
                <a href="{{ route('organisateur.historique') }}" class="flex items-center space-x-3 hover:bg-indigo-700 rounded-lg px-3 py-3 cursor-pointer transition-colors">
                    <i data-feather="calendar" class="w-5 h-5"></i>
                    <span>Historique des evenements</span>
                </a>
                <a href="{{ route('organisateur.evenement-en-cours') }}" class="flex items-center space-x-3 hover:bg-indigo-700 rounded-lg px-3 py-3 cursor-pointer transition-colors">
                    <i data-feather="calendar" class="w-5 h-5"></i>
                    <span>Gestion des Evenements en cour</span>
                </a>
                <a href="{{ route('organisateur.future.future') }}" class="flex items-center space-x-3 hover:bg-indigo-700 rounded-lg px-3 py-3 cursor-pointer transition-colors">
                    <i data-feather="calendar" class="w-5 h-5"></i>
                    <span> Evenements future</span>
                </a>
                <a href="{{ route('organisateur.evenement-passe') }}" class="flex items-center space-x-3 hover:bg-indigo-700 rounded-lg px-3 py-3 cursor-pointer transition-colors">
                    <i data-feather="calendar" class="w-5 h-5"></i>
                    <span>Evenements passe</span>
                </a>
            </nav>

            <div class="absolute bottom-0 w-full p-4 border-t border-indigo-700">
                <div class="flex items-center space-x-3">
                    <div class="hidden sm:block">
                        <p class="font-medium">Admin</p>
                        <p class="text-xs text-indigo-300">admin@eventmanager.com</p>
                    </div>
                </div>
            </div>
        </div>

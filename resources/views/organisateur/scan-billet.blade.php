@extends('layouts.Obase')
@section('title', '|Scanner des Billets')
@section('content')
<style>
@keyframes gradient-shift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes pulse-glow {
    0%, 100% { box-shadow: 0 0 20px rgba(99, 102, 241, 0.4), 0 0 40px rgba(139, 92, 246, 0.2); }
    50% { box-shadow: 0 0 30px rgba(99, 102, 241, 0.6), 0 0 60px rgba(139, 92, 246, 0.4); }
}

@keyframes scan-line {
    0% { top: 0%; }
    100% { top: 100%; }
}

.animated-gradient {
    background: linear-gradient(-45deg, #6366f1, #8b5cf6, #ec4899, #f43f5e);
    background-size: 400% 400%;
    animation: gradient-shift 15s ease infinite;
}

.float-animation {
    animation: float 3s ease-in-out infinite;
}

.pulse-glow {
    animation: pulse-glow 2s ease-in-out infinite;
}

.scan-effect::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, #10b981, transparent);
    animation: scan-line 2s linear infinite;
}

.card-hover {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.card-hover:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.stat-card {
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

@keyframes success-pop {
    0% { transform: scale(0.8); opacity: 0; }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); opacity: 1; }
}

.success-animation {
    animation: success-pop 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
}
</style>
<div class="min-h-screen animated-gradient py-8 px-4">
    <div class="max-w-5xl mx-auto">
        <!-- En-tête moderne -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl shadow-2xl shadow-indigo-500/40 mb-6 float-animation pulse-glow">
                <i class="fas fa-qrcode text-5xl text-white"></i>
            </div>
            <h1 class="text-5xl font-bold bg-gradient-to-r from-indigo-500 to-purple-600 bg-clip-text text-transparent mb-3">
                Scanner les Billets
            </h1>
            <p class="text-gray-100 text-xl">Validez l'entrée des participants en un scan</p>
        </div>

        <!-- Zone de scan principale avec effet de profondeur -->
        <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl mb-8 overflow-hidden card-hover">
            <div class="p-8 md:p-12">
                <!-- Tabs modernes -->
                <div class="bg-gray-100 p-2 rounded-2xl mb-8 flex gap-2">
                    <button class="nav-link flex-1 flex flex-col items-center justify-center py-4 px-6 rounded-xl font-semibold transition-all duration-300 bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-lg shadow-indigo-500/40" 
                            id="camera-tab" 
                            data-bs-toggle="pill" 
                            data-bs-target="#camera-scan" 
                            type="button" 
                            role="tab">
                        <i class="fas fa-camera text-2xl mb-2"></i>
                        <span>Scanner</span>
                    </button>
                    <button class="nav-link flex-1 flex flex-col items-center justify-center py-4 px-6 rounded-xl font-semibold text-gray-600 transition-all duration-300 hover:bg-indigo-50 hover:text-indigo-500" 
                            id="manual-tab" 
                            data-bs-toggle="pill" 
                            data-bs-target="#manual-scan" 
                            type="button" 
                            role="tab">
                        <i class="fas fa-keyboard text-2xl mb-2"></i>
                        <span>Saisie Manuelle</span>
                    </button>
                </div>

                <div class="tab-content">
                    <!-- Scanner avec caméra -->
                    <div class="tab-pane fade show active" id="camera-scan" role="tabpanel">
                        <div class="text-center mb-8">
                            <button type="button" 
                                    id="start-camera-btn" 
                                    class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-lg shadow-indigo-500/30 hover:shadow-xl hover:shadow-indigo-500/40 hover:-translate-y-1 transition-all duration-300">
                                <i class="fas fa-camera mr-3"></i>Activer la Caméra
                            </button>
                            <button type="button" 
                                    id="stop-camera-btn" 
                                    class="hidden inline-flex items-center px-8 py-4 text-lg font-semibold text-white bg-red-500 rounded-xl shadow-lg hover:bg-red-600 transition-all duration-300">
                                <i class="fas fa-stop-circle mr-3"></i>Arrêter
                            </button>
                        </div>

                        <!-- Zone vidéo pour la caméra -->
                        <div id="camera-container" class="hidden">
                            <div class="relative bg-black rounded-3xl overflow-hidden shadow-2xl mb-6">
                                <div class="absolute inset-0 pointer-events-none z-10">
                                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64">
                                        <div class="absolute top-0 left-0 w-10 h-10 border-t-4 border-l-4 border-green-400 rounded-tl-2xl"></div>
                                        <div class="absolute top-0 right-0 w-10 h-10 border-t-4 border-r-4 border-green-400 rounded-tr-2xl"></div>
                                        <div class="absolute bottom-0 left-0 w-10 h-10 border-b-4 border-l-4 border-green-400 rounded-bl-2xl"></div>
                                        <div class="absolute bottom-0 right-0 w-10 h-10 border-b-4 border-r-4 border-green-400 rounded-br-2xl"></div>
                                    </div>
                                </div>
                                <video id="qr-video" class="w-full h-auto rounded-3xl"></video>
                            </div>
                            <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-4 shadow-sm">
                                <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                                <span class="text-blue-700">Positionnez le QR code dans le cadre. La détection est automatique.</span>
                            </div>
                        </div>
                    </div>

                    <!-- Saisie manuelle -->
                    <div class="tab-pane fade" id="manual-scan" role="tabpanel">
                        <form id="manual-scan-form">
                            <div class="mb-8">
                                <label for="code-achat-input" class="flex items-center text-lg font-semibold text-gray-700 mb-3">
                                    <i class="fas fa-ticket-alt text-indigo-500 mr-2"></i>
                                    Code d'Achat
                                </label>
                                <input type="text" 
                                       class="w-full px-6 py-4 text-lg uppercase tracking-wider border-2 border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all duration-300 outline-none" 
                                       id="code-achat-input" 
                                       placeholder="TCK-XXXXXXXXXX" 
                                       required 
                                       autofocus>
                                <p class="mt-3 text-sm text-gray-600">
                                    <i class="fas fa-lightbulb text-yellow-500 mr-1"></i>
                                    Entrez le code visible sur le billet du participant
                                </p>
                            </div>
                            <button type="submit" 
                                    class="w-full flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-green-500 to-lime-500 rounded-xl shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40 hover:-translate-y-1 transition-all duration-300">
                                <i class="fas fa-check-circle mr-3"></i>Valider le Billet
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Zone de résultat -->
        <div id="result-container" class="hidden mb-8">
            <div id="result-card"></div>
        </div>

        <!-- Statistiques en direct -->
        <div class="bg-white/95 backdrop-blur-lg rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-4 px-6">
                <h5 class="text-lg font-bold flex items-center">
                    <i class="fas fa-chart-line mr-2"></i>Statistiques en Direct
                </h5>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-6 bg-gradient-to-br from-green-50 to-green-100/50 border-2 border-green-200 rounded-2xl stat-card">
                        <div class="text-4xl text-green-500 opacity-70 mb-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="text-4xl font-bold text-green-600 my-3" id="scan-count">0</div>
                        <div class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Billets Valides</div>
                    </div>
                    <div class="text-center p-6 bg-gradient-to-br from-red-50 to-red-100/50 border-2 border-red-200 rounded-2xl stat-card">
                        <div class="text-4xl text-red-500 opacity-70 mb-3">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="text-4xl font-bold text-red-600 my-3" id="reject-count">0</div>
                        <div class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Refusés</div>
                    </div>
                    <div class="text-center p-6 bg-gradient-to-br from-indigo-50 to-indigo-100/50 border-2 border-indigo-200 rounded-2xl stat-card">
                        <div class="text-4xl text-indigo-500 opacity-70 mb-3">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="text-4xl font-bold text-indigo-600 my-3" id="total-attempts">0</div>
                        <div class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Total Scans</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inclure la bibliothèque QR Code Scanner -->
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let html5QrCode = null;
    let scanCount = 0;
    let rejectCount = 0;
    
    const startCameraBtn = document.getElementById('start-camera-btn');
    const stopCameraBtn = document.getElementById('stop-camera-btn');
    const cameraContainer = document.getElementById('camera-container');
    const resultContainer = document.getElementById('result-container');
    const resultCard = document.getElementById('result-card');
    const manualForm = document.getElementById('manual-scan-form');
    const codeInput = document.getElementById('code-achat-input');
    
    // Gestion des tabs
    const camerTab = document.getElementById('camera-tab');
    const manualTab = document.getElementById('manual-tab');
    
    camerTab.addEventListener('click', function() {
        camerTab.classList.add('bg-gradient-to-br', 'from-indigo-500', 'to-purple-600', 'text-white', 'shadow-lg', 'shadow-indigo-500/40');
        camerTab.classList.remove('text-gray-600', 'hover:bg-indigo-50', 'hover:text-indigo-500');
        manualTab.classList.remove('bg-gradient-to-br', 'from-indigo-500', 'to-purple-600', 'text-white', 'shadow-lg', 'shadow-indigo-500/40');
        manualTab.classList.add('text-gray-600', 'hover:bg-indigo-50', 'hover:text-indigo-500');
    });
    
    manualTab.addEventListener('click', function() {
        manualTab.classList.add('bg-gradient-to-br', 'from-indigo-500', 'to-purple-600', 'text-white', 'shadow-lg', 'shadow-indigo-500/40');
        manualTab.classList.remove('text-gray-600', 'hover:bg-indigo-50', 'hover:text-indigo-500');
        camerTab.classList.remove('bg-gradient-to-br', 'from-indigo-500', 'to-purple-600', 'text-white', 'shadow-lg', 'shadow-indigo-500/40');
        camerTab.classList.add('text-gray-600', 'hover:bg-indigo-50', 'hover:text-indigo-500');
    });
    
    // Démarrer la caméra
    startCameraBtn.addEventListener('click', startCamera);
    stopCameraBtn.addEventListener('click', stopCamera);
    
    function startCamera() {
        cameraContainer.classList.remove('hidden');
        startCameraBtn.classList.add('hidden');
        stopCameraBtn.classList.remove('hidden');
        
        html5QrCode = new Html5Qrcode("qr-video");
        
        html5QrCode.start(
            { facingMode: "environment" },
            {
                fps: 10,
                qrbox: { width: 250, height: 250 }
            },
            onScanSuccess,
            onScanFailure
        ).catch(err => {
            console.error('Erreur caméra:', err);
            alert('Impossible d\'accéder à la caméra. Vérifiez les permissions.');
            stopCamera();
        });
    }
    
    function stopCamera() {
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                cameraContainer.classList.add('hidden');
                startCameraBtn.classList.remove('hidden');
                stopCameraBtn.classList.add('hidden');
                html5QrCode = null;
            });
        }
    }
    
    function onScanSuccess(decodedText) {
        if (html5QrCode) {
            html5QrCode.pause();
        }
        
        if (navigator.vibrate) {
            navigator.vibrate(100);
        }
        
        processScan(decodedText);
    }
    
    function onScanFailure(error) {
        // Ne rien faire
    }
    
    // Formulaire manuel
    manualForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const codeAchat = codeInput.value.trim();
        
        if (codeAchat) {
            fetch(`/scan-qr`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    qr_data: JSON.stringify({
                        code_achat: codeAchat,
                        email_acheteur: 'manual@scan.com',
                        verification: {
                            hash: 'manual_scan'
                        }
                    })
                })
            })
            .then(response => response.json())
            .then(data => {
                displayResult(data);
                codeInput.value = '';
            })
            .catch(error => {
                console.error('Erreur:', error);
                displayResult({
                    success: false,
                    message: 'Erreur de connexion au serveur'
                });
            });
        }
    });
    
    function processScan(qrData) {
        fetch(`/scan-qr`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ qr_data: qrData })
        })
        .then(response => response.json())
        .then(data => {
            displayResult(data);
            
            if (html5QrCode) {
                setTimeout(() => {
                    html5QrCode.resume();
                }, 3000);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            displayResult({
                success: false,
                message: 'Erreur de connexion au serveur'
            });
            
            if (html5QrCode) {
                setTimeout(() => {
                    html5QrCode.resume();
                }, 3000);
            }
        });
    }
    
    function displayResult(data) {
        resultContainer.classList.remove('hidden');
        
        if (data.success) {
            scanCount++;
            playSound('success');
        } else {
            rejectCount++;
            playSound('error');
        }
        
        animateCounter(document.getElementById('scan-count'), scanCount);
        animateCounter(document.getElementById('reject-count'), rejectCount);
        animateCounter(document.getElementById('total-attempts'), scanCount + rejectCount);
        
        if (data.success) {
            resultCard.className = 'bg-gradient-to-br from-green-50 to-green-100/50 border-4 border-green-500 rounded-3xl p-8 mb-8 success-animation';
            resultCard.innerHTML = `
                <div class="text-center mb-6">
                    <i class="fas fa-check-circle text-green-500 text-8xl"></i>
                    <h3 class="text-green-600 text-3xl font-bold mt-4">${data.message}</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <div class="p-3 bg-indigo-50 rounded-lg">
                            <i class="fas fa-ticket-alt text-indigo-500 mr-2"></i>
                            <strong>Code:</strong> ${data.transaction.code_achat}
                        </div>
                        <div class="p-3 bg-indigo-50 rounded-lg">
                            <i class="fas fa-user text-indigo-500 mr-2"></i>
                            <strong>Nom:</strong> ${data.transaction.nom_acheteur}
                        </div>
                        <div class="p-3 bg-indigo-50 rounded-lg">
                            <i class="fas fa-envelope text-indigo-500 mr-2"></i>
                            <strong>Email:</strong> ${data.transaction.email_acheteur}
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="p-3 bg-indigo-50 rounded-lg">
                            <i class="fas fa-calendar text-indigo-500 mr-2"></i>
                            <strong>Événement:</strong> ${data.transaction.evenement}
                        </div>
                        <div class="p-3 bg-indigo-50 rounded-lg">
                            <i class="fas fa-layer-group text-indigo-500 mr-2"></i>
                            <strong>Type:</strong> ${data.transaction.type_billet}
                        </div>
                        <div class="p-3 bg-indigo-50 rounded-lg">
                            <i class="fas fa-users text-indigo-500 mr-2"></i>
                            <strong>Quantité:</strong> ${data.transaction.quantite}
                        </div>
                    </div>
                </div>
                <div class="text-center mt-6 pt-4 border-t-2 border-green-200">
                    <small class="text-gray-600">
                        <i class="fas fa-clock mr-1"></i>
                        Scanné à ${data.transaction.scanne_maintenant} par ${data.transaction.scanne_par}
                    </small>
                </div>
            `;
        } else {
            const scanInfo = data.scan_info || {};
            resultCard.className = 'bg-gradient-to-br from-red-50 to-red-100/50 border-4 border-red-500 rounded-3xl p-8 mb-8 animate-bounce';
            resultCard.innerHTML = `
                <div class="text-center mb-6">
                    <i class="fas fa-times-circle text-red-500 text-8xl"></i>
                    <h3 class="text-red-600 text-3xl font-bold mt-4">ACCÈS REFUSÉ</h3>
                    <p class="text-xl text-gray-600 mt-2">${data.message}</p>
                </div>
                ${data.error_type === 'already_scanned' && scanInfo.premier_scan ? `
                    <div class="bg-yellow-50 border-2 border-yellow-300 rounded-xl p-4 shadow-sm">
                        <h6 class="font-bold text-yellow-800 mb-3 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Informations du scan
                        </h6>
                        <hr class="border-yellow-200 mb-3">
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div class="font-semibold">Premier scan:</div>
                            <div>${scanInfo.premier_scan}</div>
                            <div class="font-semibold">Dernier scan:</div>
                            <div>${scanInfo.dernier_scan}</div>
                            <div class="font-semibold">Tentatives:</div>
                            <div>${scanInfo.nombre_tentatives}</div>
                            <div class="font-semibold">Scanné par:</div>
                            <div>${scanInfo.scanne_par}</div>
                        </div>
                    </div>
                ` : ''}
            `;
        }
        
        setTimeout(() => {
            resultContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 100);
    }
    
    function animateCounter(element, target) {
        const start = parseInt(element.textContent);
        const duration = 500;
        const increment = (target - start) / (duration / 16);
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            if ((increment > 0 && current >= target) || (increment < 0 && current <= target)) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.round(current);
            }
        }, 16);
    }
    
    function playSound(type) {
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const oscillator = audioContext.createOscillator();
        const gainNode = audioContext.createGain();
        
        oscillator.connect(gainNode);
        gainNode.connect(audioContext.destination);
        
        if (type === 'success') {
            oscillator.frequency.value = 800;
            gainNode.gain.value = 0.3;
            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.1);
        } else {
            oscillator.frequency.value = 300;
            gainNode.gain.value = 0.3;
            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.3);
        }
    }
});
</script>
@endsection
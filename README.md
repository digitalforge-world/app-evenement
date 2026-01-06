# EventApp - Système de Gestion d'Événements et Billetterie 🎟️

**EventApp** est une solution complète développée avec Laravel pour simplifier l'organisation, la promotion et la gestion des ventes de tickets pour tous types d'événements.

---

## 🚀 Fonctionnalités Clés

### 👤 Pour les Utilisateurs (Public)
- **Découverte d'Événements** : Navigation fluide à travers les événements à venir.
- **Achat de Billets** : Processus de commande simple et sécurisé pour obtenir des tickets de participation.
- **Confirmation par Email** : Réception automatique des détails de la commande.
- **Espace Personnel** : Accès à l'historique des participations.

### 💼 Pour les Organisateurs
- **Tableau de Bord Dynamique** : Vue d'ensemble des statistiques de ventes et de fréquentation.
- **Gestion des Événements** : CRUD complet (Création, Lecture, Mise à jour, Suppression) avec gestion des images de couverture.
- **Contrôle d'Accès par QR Code** : Scanner intégré pour valider les billets à l'entrée de l'événement et éviter les fraudes.
- **Gestion des Catégories** : Organisation des événements par thématique (Musique, Tech, Formation, etc.).

---

## 🛠️ Stack Technique

- **Framework PHP** : [Laravel](https://laravel.com)
- **Frontend** : Blade, JavaScript, CSS 3 (Stylisation moderne)
- **Base de Données** : MySQL
- **Outils Spécifiques** : Intégration de génération et scan de QR Codes.

---

## ⚙️ Installation & Configuration

### Prérequis
- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

### Étapes d'installation

1. **Cloner le projet**
   ```bash
   git clone https://github.com/digitalforge-world/app-evenement.git
   cd app-evenement
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Installer les dépendances Frontend**
   ```bash
   npm install
   npm run build
   ```

4. **Configuration de l'environnement**
   - Copiez le fichier `.env.example` vers `.env`
   - Configurez vos accès à la base de données dans le fichier `.env`
   ```bash
   php artisan key:generate
   ```

5. **Migrations et Données**
   ```bash
   php artisan migrate --seed
   ```

6. **Lancer le serveur**
   ```bash
   php artisan serve
   ```

---

## 📱 Utilisation du Scanner
Pour valider les billets, les organisateurs peuvent utiliser l'interface de scan dédiée qui utilise la caméra de l'appareil pour lire les QR codes générés sur les tickets clients.

---

## 📧 Contact & Support
Développé par **DigitalForge**.  
Lien du profil : [digitalforge-world](https://github.com/digitalforge-world)

---
*Ce projet a été initialisé pour répondre aux besoins de digitalisation de l'événementiel.*

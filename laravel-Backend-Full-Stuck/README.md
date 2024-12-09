# TE-Elearning-Platform-Backend

TE-Elearning-Platform-Backend est le backend d'une plateforme d'apprentissage en ligne, développé avec Laravel. Il gère les fonctionnalités principales telles que l'authentification, la gestion des cours, des utilisateurs, et la communication avec la base de données. Ce projet est conçu pour être performant, sécurisé et extensible.

---
resources/
├── views/
│   ├── auth/                   # Authentication-related views
│   │   ├── login.blade.php
│   │   ├── register.blade.php
│   │   ├── forgot-password.blade.php
│   └── dashboards/             # Dashboards for different roles
│       ├── admin-dashboard.blade.php
│       ├── coach-dashboard.blade.php
│       ├── user-dashboard.blade.php
│   ├── courses/                # Course management views
│       ├── index.blade.php       # List of courses
│       ├── show.blade.php        # Course details
│       ├── create.blade.php      # Create course form
│       ├── edit.blade.php        # Edit course form
│   ├── exams/                  # Exam management views
│       ├── index.blade.php       # List of exams
│       ├── show.blade.php        # Exam details
│       ├── take.blade.php        # Take exam page
│   ├── hse/                    # HSE training and reporting
│       ├── training.blade.php
│       ├── dashboard.blade.php
│   ├── users/                  # User management views
│       ├── index.blade.php       # List of users
│       ├── show.blade.php        # User details
│   ├── shared/                 # Shared or reusable views
│       ├── not-found.blade.php
│       ├── error.blade.php
│   └── settings/               # Application or user settings
│       ├── general.blade.php     # General settings
│       ├── profile.blade.php     # User profile settings
│
└── layouts/                    # Application layouts
    ├── app.blade.php             # Main layout for authenticated users
    ├── guest.blade.php           # Layout for guest (unauthenticated) users

---

## **Description des composants**

### **auth/**
- **login.blade.php** : Formulaire de connexion pour les utilisateurs.
- **register.blade.php** : Formulaire d'inscription pour les nouveaux utilisateurs.
- **forgot-password.blade.php** : Formulaire de récupération du mot de passe.

### **dashboards/**
- **admin-dashboard.blade.php** : Tableau de bord pour les administrateurs pour gérer les cours, utilisateurs, et surveiller les activités.
- **coach-dashboard.blade.php** : Tableau de bord pour les coaches pour gérer leurs cours et utilisateurs inscrits.
- **user-dashboard.blade.php** : Tableau de bord utilisateur pour suivre les progrès, voir les cours et accéder aux examens.

### **courses/**
- **index.blade.php** : Affiche la liste des cours disponibles.
- **show.blade.php** : Détails d'un cours spécifique.
- **create.blade.php** : Formulaire pour créer un nouveau cours.
- **edit.blade.php** : Formulaire pour modifier un cours existant.

### **exams/**
- **index.blade.php** : Liste des examens disponibles.
- **show.blade.php** : Détails d'un examen.
- **take.blade.php** : Interface pour passer un examen.

### **hse/**
- **training.blade.php** : Contenu de formation HSE pour les utilisateurs.
- **dashboard.blade.php** : Tableau de bord pour les rapports et le statut de formation HSE.

### **users/**
- **index.blade.php** : Liste des utilisateurs.
- **show.blade.php** : Détails d'un utilisateur.

### **shared/**
- **not-found.blade.php** : Page d'erreur 404.
- **error.blade.php** : Page d'erreur générale.

### **settings/**
- **general.blade.php** : Paramètres généraux de l'application (administrateurs).
- **profile.blade.php** : Paramètres du profil utilisateur.

### **layouts/**
- **app.blade.php** : Layout principal pour les utilisateurs authentifiés (avec en-tête, barre latérale, et pied de page).
- **guest.blade.php** : Layout simplifié pour les utilisateurs non authentifiés (par exemple, pages de connexion).

---

## **Contributeurs**
Merci à l'équipe pour ses contributions. Pour signaler un bug ou proposer une fonctionnalité, veuillez utiliser l'onglet [Issues](https://github.com/votre-repo/issues).

## **Licence**
Ce projet est sous licence [MIT](https://opensource.org/licenses/MIT).

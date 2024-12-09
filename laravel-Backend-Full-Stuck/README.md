# TE-Elearning-Platform-Backend

TE-Elearning-Platform-Backend est le backend d'une plateforme d'apprentissage en ligne, développé avec Laravel. Il gère les fonctionnalités principales telles que l'authentification, la gestion des cours, des utilisateurs, et la communication avec la base de données. Ce projet est conçu pour être performant, sécurisé et extensible.

---

## **Structure du répertoire**

```txt
resources/
├── views/
│   ├── auth/                   # Vues liées à l'authentification
│   │   ├── login.blade.php     # Page de connexion
│   │   ├── register.blade.php  # Page d'inscription
│   │   ├── forgot-password.blade.php # Page de récupération du mot de passe
│   └── dashboards/             # Tableaux de bord selon les rôles
│       ├── admin-dashboard.blade.php # Tableau de bord administrateur
│       ├── coach-dashboard.blade.php # Tableau de bord coach
│       ├── user-dashboard.blade.php  # Tableau de bord utilisateur
│   ├── courses/                # Gestion des cours
│       ├── index.blade.php     # Liste des cours
│       ├── show.blade.php      # Détails d'un cours
│       ├── create.blade.php    # Formulaire de création de cours
│       ├── edit.blade.php      # Formulaire de modification de cours
│   ├── exams/                  # Gestion des examens
│       ├── index.blade.php     # Liste des examens
│       ├── show.blade.php      # Détails d'un examen
│       ├── take.blade.php      # Interface pour passer un examen
│   ├── hse/                    # Formation et rapports HSE
│       ├── training.blade.php  # Contenu de formation HSE
│       ├── dashboard.blade.php # Tableau de bord HSE
│   ├── users/                  # Gestion des utilisateurs
│       ├── index.blade.php     # Liste des utilisateurs
│       ├── show.blade.php      # Détails d'un utilisateur
│   ├── shared/                 # Vues réutilisables
│       ├── not-found.blade.php # Page 404
│       ├── error.blade.php     # Page d'erreur générale
│   └── settings/               # Paramètres de l'application ou utilisateur
│       ├── general.blade.php   # Paramètres généraux
│       ├── profile.blade.php   # Paramètres du profil utilisateur
│
└── layouts/                    # Layouts de l'application
    ├── app.blade.php           # Layout principal pour les utilisateurs connectés
    ├── guest.blade.php         # Layout pour les utilisateurs invités


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

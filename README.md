# TE-Elearning-Platform-Backend

TE-Elearning-Platform-Backend est le backend d'une plateforme d'apprentissage en ligne, développé avec Laravel. Il gère les fonctionnalités principales telles que l'authentification, la gestion des cours, des utilisateurs, et la communication avec la base de données. Ce projet est conçu pour être performant, sécurisé et extensible.

---
## **Creating Migrations for Database Tables**

To set up the necessary database tables for the TE-Elearning-Platform, you can generate the migrations using the following commands. Each command creates a migration for a corresponding table in the database.

### **Step-by-step Migration Creation**

1. **Create the `users` table migration:**
   This command will generate a migration file for the `users` table.
   ```bash
   php artisan make:migration create_users_table --create=users
   ```
2. **Create the `admins` table migration:**
    This will generate a migration for the admins table, which stores the admin-specific data.
   ```bash
    php artisan make:migration create_admins_table --create=admins
   ```
3. **Create the `courses` table migration:**
   This command will generate a migration file for the `courses` table.
   ```bash
   php artisan make:migration create_courses_table --create=courses
   ```
4. **Create the `exams` table migration:**
   This command will generate a migration file for the `exams` table.
   ```bash
   php artisan make:migration create_exams_table --create=exams
   ```
5. **Create the `questions` table migration:**
   This command will generate a migration file for the `questions` table.
   ```bash
   php artisan make:migration create_questions_table --create=questions
   ```
6. **Create the `answers` table migration:**
   This command will generate a migration file for the `answers` table.
   ```bash
   php artisan make:migration create_answers_table --create=answers
   ```
7. **Create the `enrollments` table migration:**
   This command will generate a migration file for the `enrollments` table.
   ```bash
   php artisan make:migration create_enrollments_table --create=enrollments
   ```
8. **Create the `exam_results` table migration:**
   This command will generate a migration file for the `exam_results` table.
   ```bash
   php artisan make:migration create_exam_results_table --create=exam_results
   ```



## **Database Schema Structure**
```txt
database/
├── migrations/
│   ├── 2024_12_09_000001_create_users_table.php           # Users table
│   ├── 2024_12_09_000002_create_courses_table.php         # Courses table
│   ├── 2024_12_09_000003_create_exams_table.php           # Exams table
│   ├── 2024_12_09_000004_create_enrollments_table.php     # Enrollments table
│   ├── 2024_12_09_000005_create_exam_results_table.php    # Exam Results table
│   ├── 2024_12_09_000006_create_questions_table.php       # Questions table
│   ├── 2024_12_09_000007_create_answers_table.php         # Answers table
│   ├── 2024_12_09_000008_create_hse_trainings_table.php   # HSE Trainings table
│   ├── 2024_12_09_000009_create_roles_table.php           # User roles table
│   ├── 2024_12_09_000010_create_permissions_table.php     # User permissions table
│   ├── 2024_12_09_000011_create_user_permissions_table.php # Pivot table between users and permissions
│   └── 2024_12_09_000012_create_course_exams_table.php    # Pivot table between courses and exams
├── seeders/
│   ├── UserSeeder.php             # Seeds for the users
│   ├── CourseSeeder.php           # Seeds for the courses
│   ├── ExamSeeder.php             # Seeds for the exams
│   ├── EnrollmentSeeder.php       # Seeds for the enrollments
│   ├── QuestionSeeder.php         # Seeds for the questions
│   ├── AnswerSeeder.php           # Seeds for the answers
│   ├── HSETrainingSeeder.php      # Seeds for HSE training data
│   └── RoleSeeder.php             # Seeds for the roles
└── factories/
    ├── UserFactory.php            # Factory for creating users
    ├── CourseFactory.php          # Factory for creating courses
    ├── ExamFactory.php            # Factory for creating exams
    ├── EnrollmentFactory.php      # Factory for creating enrollments
    ├── QuestionFactory.php        # Factory for creating questions
    └── AnswerFactory.php          # Factory for creating answers
```
## Description of the Tables

### `users` table
Stores information about the users (students, admins, coaches).

**Fields:**
- `id`
- `name`
- `email`
- `password`
- `role_id`
- `created_at`
- `updated_at`

---

### `courses` table
Contains information about courses.

**Fields:**
- `id`
- `title`
- `description`
- `creator_id`
- `status`
- `start_date`
- `end_date`
- `created_at`
- `updated_at`

---

### `exams` table
Stores information about exams associated with courses.

**Fields:**
- `id`
- `title`
- `description`
- `course_id`
- `created_at`
- `updated_at`

---

### `enrollments` table
Tracks which users are enrolled in which courses.

**Fields:**
- `id`
- `user_id`
- `course_id`
- `created_at`
- `updated_at`

**Constraints:**
- `user_id`, `course_id` should be unique (a user can only be enrolled in a course once).

---

### `exam_results` table
Stores the results of users' exams.

**Fields:**
- `id`
- `user_id`
- `exam_id`
- `score`
- `status`
- `created_at`
- `updated_at`

**Status:** 
- e.g., `passed`, `failed`

---

### `questions` table
Stores the questions for exams.

**Fields:**
- `id`
- `exam_id`
- `question_text`
- `correct_answer`
- `created_at`
- `updated_at`

---

### `answers` table
Stores answers related to each question.

**Fields:**
- `id`
- `question_id`
- `answer_text`
- `is_correct`
- `created_at`
- `updated_at`

---

### `hse_trainings` table
Stores data about Health, Safety, and Environment (HSE) trainings.

**Fields:**
- `id`
- `user_id`
- `training_title`
- `completion_status`
- `completion_date`
- `created_at`
- `updated_at`

---

### `roles` table
Defines the different roles for users (e.g., admin, coach, user).

**Fields:**
- `id`
- `role_name`
- `created_at`
- `updated_at`

---

### `permissions` table
Defines permissions for different roles (e.g., can create course, take exam).

**Fields:**
- `id`
- `permission_name`
- `created_at`
- `updated_at`

---

### `user_permissions` table
A pivot table to link users with specific permissions.

**Fields:**
- `user_id`
- `permission_id`

---

### `course_exams` table
A pivot table to link courses with the exams associated with them.

**Fields:**
- `course_id`
- `exam_id`

---

## Relationships

- **User to Role:**
  - A user has one role. The `roles` table defines the role (e.g., admin, coach, student).

- **User to Enrollment:**
  - A user can enroll in many courses through the `enrollments` table.

- **Course to Exam:**
  - A course can have many exams, and an exam belongs to one course.

- **User to ExamResult:**
  - A user can have multiple exam results (one for each exam they take).

- **Exam to Question:**
  - An exam has many questions. Each question is associated with one exam.

- **Question to Answer:**
  - A question can have many possible answers. One answer is correct.

- **User to HSETraining:**
  - A user can complete multiple HSE training courses.

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
```

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

note:
Docker Image: mohammed761/te-backend
Tag: v1.0
Docker Hub Username: mohammed761

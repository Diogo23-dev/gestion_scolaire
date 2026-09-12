# 🎓 Application de Gestion Scolaire

Application web de gestion scolaire développée avec **Laravel** et **Livewire**.
Elle a pour objectif de centraliser la gestion des élèves, des classes, des matières, des inscriptions et des notes au sein d'une seule application.

---

## 📌 Présentation

Cette application permet à un établissement scolaire de remplacer une partie de ses processus de gestion sur papier par une solution numérique centralisée.

Elle permet notamment de :

* gérer les années scolaires ;
* gérer les niveaux et les classes ;
* gérer les élèves ;
* attribuer un matricule permanent aux élèves ;
* gérer les matières ;
* inscrire les élèves dans une classe pour une année scolaire ;
* enregistrer les notes ;
* consulter les informations depuis un tableau de bord ;
* suivre les principales statistiques de l'établissement.

L'application est conçue pour être évolutive afin d'intégrer progressivement d'autres fonctionnalités telles que la gestion des utilisateurs, des paiements, des bulletins et des rapports.

---

## 🚀 Fonctionnalités

### 📊 Tableau de bord

Le tableau de bord permet de consulter rapidement :

* le nombre total d'élèves ;
* le nombre de classes ;
* le nombre de matières ;
* le nombre d'inscriptions pour l'année scolaire active ;
* le nombre de notes enregistrées ;
* les dernières inscriptions ;
* l'année scolaire active.

### 👨‍🎓 Gestion des élèves

* Création d'un élève ;
* Modification des informations ;
* Suppression d'un élève ;
* Consultation des élèves ;
* Génération automatique du matricule ;
* Matricule permanent associé à l'élève durant toute sa scolarité.

### 📚 Gestion des matières

* Création des matières ;
* Modification des matières ;
* Suppression des matières ;
* Code de la matière ;
* Gestion du coefficient.

### 🏫 Gestion des niveaux et classes

* Création des niveaux ;
* Création des classes ;
* Association d'une classe à un niveau ;
* Modification et suppression des classes.

### 📅 Gestion des années scolaires

* Création d'une année scolaire ;
* Définition de la date de début ;
* Définition de la date de fin ;
* Activation d'une année scolaire ;
* Consultation des années scolaires.

### 📝 Gestion des inscriptions

Une inscription permet d'associer :

```text
Élève
   ↓
Classe
   ↓
Année scolaire
```

L'application permet ainsi de suivre le parcours scolaire d'un élève année après année.

### 📈 Gestion des notes

Les notes sont associées à une inscription et à une matière :

```text
Inscription
     ↓
   Note
     ↓
  Matière
```

Chaque note possède une valeur numérique.

---

## 🛠️ Technologies utilisées

| Technologie   | Utilisation                 |
| ------------- | --------------------------- |
| PHP           | Langage principal           |
| Laravel 13    | Framework backend           |
| Livewire 4    | Interfaces dynamiques       |
| Blade         | Templates et vues           |
| Tailwind CSS  | Interface utilisateur       |
| SQLite        | Base de données             |
| Composer      | Gestion des dépendances PHP |
| Node.js / NPM | Gestion des outils frontend |
| Git / GitHub  | Versionnement du code       |

---

## 🏗️ Architecture actuelle

L'application utilise principalement les modèles suivants :

```text
SchoolYear
    │
    └── Enrollment
          │
          ├── Student
          │
          ├── SchoolClass
          │
          └── Grade
                 │
                 └── Subject
```

### Principaux modèles

* `Student` — Élève
* `SchoolYear` — Année scolaire
* `SchoolLevel` — Niveau scolaire
* `SchoolClass` — Classe
* `Subject` — Matière
* `Enrollment` — Inscription
* `Grade` — Note

---

## 📂 Structure du projet

```text
laravel13livewire/
│
├── app/
│   ├── Models/
│   │   ├── Student.php
│   │   ├── SchoolYear.php
│   │   ├── SchoolLevel.php
│   │   ├── SchoolClass.php
│   │   ├── Subject.php
│   │   ├── Enrollment.php
│   │   └── Grade.php
│   │
│   └── ...
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── resources/
│   └── views/
│       ├── components/
│       │   ├── dashboard.blade.php
│       │   ├── students/
│       │   ├── subjects/
│       │   ├── school-years/
│       │   ├── enrollments/
│       │   └── grades/
│       │
│       └── ...
│
├── routes/
│   └── web.php
│
├── public/
├── storage/
├── tests/
├── .env.example
├── composer.json
├── package.json
└── README.md
```

---

## ⚙️ Installation

### 1. Cloner le projet

```bash
git clone https://github.com/Diogo23-dev/gestion_scolaire.git
```

Puis :

```bash
cd laravel13livewire
```

---

### 2. Installer les dépendances PHP

```bash
composer install
```

---

### 3. Installer les dépendances JavaScript

```bash
npm install
```

---

### 4. Configurer l'environnement

Copier le fichier `.env.example` :

```bash
cp .env.example .env
```

Sous Windows PowerShell, vous pouvez utiliser :

```powershell
Copy-Item .env.example .env
```

Puis générer la clé de l'application :

```bash
php artisan key:generate
```

---

## 🗄️ Configuration de la base de données

L'application utilise actuellement **SQLite**.

Créer le fichier :

```text
database/database.sqlite
```

Puis vérifier dans `.env` :

```env
DB_CONNECTION=sqlite
```

Les autres paramètres de base de données ne sont normalement pas nécessaires avec SQLite.

---

## 🔄 Migration de la base de données

Pour créer les tables :

```bash
php artisan migrate
```

Pour recréer complètement la base de données et exécuter les seeders :

```bash
php artisan migrate:fresh --seed
```

> ⚠️ `migrate:fresh --seed` supprime les tables existantes avant de les recréer. Cette commande est principalement destinée au développement.

---

## ▶️ Lancer l'application

Lancer le serveur Laravel :

```bash
composer run dev
```

Puis ouvrir :

```text
http://127.0.0.1:8000
```

---

## 🔐 Authentification

L'application utilise le système d'authentification fourni par Laravel.

Les fonctionnalités de gestion scolaire sont protégées par authentification.

Les routes principales sont actuellement protégées par :

```php
Route::middleware(['auth', 'verified'])->group(function () {
    // Routes protégées
});
```

---

## 🎨 Interface utilisateur

L'interface utilise **Tailwind CSS** avec une attention particulière portée à :

* la responsivité ;
* le mode clair ;
* le mode sombre ;
* la lisibilité ;
* les composants réutilisables ;
* les cartes et tableaux ;
* les boutons d'action ;
* les messages de confirmation et d'erreur.

Le design utilise principalement une palette **Slate** avec des composants aux coins arrondis et des bordures discrètes.

---

## 🧪 Tests

Pour exécuter les tests :

```bash
php artisan test
```

Ou :

```bash
vendor/bin/phpunit
```

---

## 🧹 Commandes utiles

### Nettoyer les caches

```bash
php artisan optimize:clear
```

### Vérifier les routes

```bash
php artisan route:list
```

### Créer un modèle

```bash
php artisan make:model NomDuModele
```

### Créer une migration

```bash
php artisan make:migration create_nom_table
```

### Créer un composant Livewire

```bash
php artisan make:livewire nom-du-composant
```

### Recréer la base de données

```bash
php artisan migrate:fresh --seed
```

---

## 📋 Modèle de données

### Students

```text
students
├── id
├── matricule
├── first_name
├── last_name
├── date_of_birth
├── gender
└── timestamps
```

### School Years

```text
school_years
├── id
├── name
├── starts_at
├── ends_at
├── is_active
└── timestamps
```

### School Levels

```text
school_levels
├── id
├── name
└── timestamps
```

### School Classes

```text
school_classes
├── id
├── name
├── level_id
└── timestamps
```

### Subjects

```text
subjects
├── id
├── name
├── code
├── coefficient
└── timestamps
```

### Enrollments

```text
enrollments
├── id
├── student_id
├── class_id
├── school_year_id
└── timestamps
```

### Grades

```text
grades
├── id
├── enrollment_id
├── subject_id
├── value
└── timestamps
```

---

## 🔗 Relations principales

### Student

Un élève peut avoir plusieurs inscriptions :

```text
Student 1 ──────── * Enrollment
```

### School Year

Une année scolaire peut avoir plusieurs inscriptions :

```text
SchoolYear 1 ──────── * Enrollment
```

### School Class

Une classe peut avoir plusieurs inscriptions :

```text
SchoolClass 1 ──────── * Enrollment
```

### Enrollment

Une inscription peut avoir plusieurs notes :

```text
Enrollment 1 ──────── * Grade
```

### Subject

Une matière peut être associée à plusieurs notes :

```text
Subject 1 ──────── * Grade
```

---

## 🔮 Évolutions prévues

L'application est conçue pour évoluer progressivement.

### Gestion administrative

* [x] Gestion des années scolaires
* [x] Gestion des niveaux
* [x] Gestion des classes
* [x] Gestion des élèves
* [x] Gestion des matières
* [x] Gestion des inscriptions
* [x] Gestion des notes
* [x] Tableau de bord

### Prochaines fonctionnalités

* [ ] Gestion avancée des utilisateurs
* [ ] Gestion des rôles et permissions
* [ ] Gestion des enseignants
* [ ] Gestion des parents/tuteurs
* [ ] Gestion des paiements et frais scolaires
* [ ] Calcul automatique des moyennes
* [ ] Bulletins scolaires
* [ ] Relevés de notes
* [ ] Génération de documents PDF
* [ ] Recherche et filtres avancés
* [ ] Statistiques scolaires avancées
* [ ] Historique des résultats
* [ ] Notifications
* [ ] Sauvegarde et restauration des données
* [ ] API
* [ ] Version mobile/PWA

---

## 🎯 Objectifs du projet

Les principaux objectifs sont :

1. **Réduire la dépendance aux documents papier.**
2. **Éviter la perte des données scolaires.**
3. **Centraliser les informations de l'établissement.**
4. **Faciliter le suivi des élèves.**
5. **Améliorer la gestion des inscriptions et des notes.**
6. **Fournir un tableau de bord permettant de suivre rapidement l'activité scolaire.**
7. **Préparer une solution évolutive pouvant gérer l'ensemble du fonctionnement administratif d'un établissement scolaire.**

---

## 🔒 Sécurité

Quelques bonnes pratiques appliquées :

* authentification des utilisateurs ;
* protection des routes administratives ;
* utilisation de l'ORM Eloquent ;
* validation des données ;
* protection contre les mass assignments avec `$fillable` ;
* utilisation des variables d'environnement pour la configuration ;
* séparation entre logique métier et interface utilisateur.

> Ne jamais versionner le fichier `.env` contenant des informations sensibles.

---

## 💻 Environnement de développement

Projet développé dans un environnement local avec :

```text
Windows
Laravel Herd
PHP 8.4+
Laravel 13
Livewire 4
SQLite
Node.js
NPM
Git
GitHub
```

---

## 📌 Statut du projet

**🚧 En développement actif**

Les fonctionnalités principales de gestion scolaire sont progressivement développées et intégrées.

Le projet suit une approche évolutive : les fonctionnalités sont ajoutées, testées et améliorées progressivement avant d'être intégrées à la version finale.

---

## 👨‍💻 Auteur

**Abdoulaye Diogo Diallo**

Développeur informatique — Guinée

Projet personnel de développement d'une solution de gestion scolaire.

---

## 📄 Licence

Ce projet est actuellement destiné à un usage de développement et de démonstration.

La licence pourra être définie ultérieurement selon le mode de distribution choisi.

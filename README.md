# Leboncoin Clone

Ce projet est une implémentation clone du site Leboncoin. Il permet aux utilisateurs de publier, gérer et rechercher des annonces pour divers produits et de communiquer via un système de messagerie interne.

## Fonctionnalités

- **Gestion des Annonces** : Les utilisateurs peuvent ajouter, modifier, supprimer leurs annonces et les marquer comme vendues.
- **Système de Messagerie** : Communication directe entre acheteurs et vendeurs via un chat intégré.
- **Recherche et Filtres** : Les annonces peuvent être filtrées par catégorie, prix et état, ou recherchées par mots-clés.
- **Responsive Design** : Le site est conçu pour être utilisé sur divers appareils, y compris les mobiles et les tablettes.

## Technologies Utilisées

- **Frontend** : HTML, CSS, JavaScript
- **Backend** : PHP, MySQL
- **Frameworks/Libraries** : Bootstrap pour le CSS

## Installation

Pour installer et configurer le projet localement, suivez les étapes ci-dessous :

```bash
git clone https://github.com/Neruaka/Leboncoin.git
cd Leboncoin
Configurez votre serveur MySQL et importez le fichier leboncoin.sql pour initialiser la base de données. Configurez ensuite le fichier connexion.php avec les détails de votre base de données.

Lancez votre serveur web local et accédez au projet via un navigateur web.

Utilisation
Naviguez à travers les diverses pages web pour créer un compte, se connecter, publier des annonces, et interagir avec d'autres utilisateurs via le système de messagerie.

Structure du Projet
connexion.php : Fichier de connexion à la base de données.
htmlbasics.php : Contient le HTML de base partagé entre les pages.
homepage.php : Affiche les annonces à la une.
categorie.php : Affiche les annonces par catégorie.
Contributions
Les contributions à ce projet sont bienvenues. Suivez ces étapes pour contribuer :

Fork le dépôt.
Créez votre branche de fonctionnalités (git checkout -b feature/AmazingFeature).
Committez vos changements (git commit -m 'Add some AmazingFeature').
Push sur la branche (git push origin feature/AmazingFeature).
Ouvrez une Pull Request.

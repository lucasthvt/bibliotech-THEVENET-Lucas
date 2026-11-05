# 📋 Ma progression — BiblioTech

> Cochez (`[ ]` → `[x]`) au fur et à mesure, puis **committez** ce fichier.
> Une mission 🟢 ou 🟡 n'est cochée que si ses tests passent.

**Nom :** · **Dépôt :** · **URL de mise en ligne (séance 8) :**

---

## 🚀 Mise en route
- [ ] Dépôt créé depuis le modèle, Codespace ouvert
- [ ] L'application s'affiche (port 8000), phpMyAdmin aussi (port 8080)
- [ ] `php artisan test --group=socle` : 8 tests verts

## 1️⃣ Routes, contrôleurs, vues
- [ ] 🎓 Fiche [MVC et routage](cours/01-mvc-routage.md) + auto-évaluation
- [ ] 🟢 1.1 Lire le trajet d'une requête (questions du guide)
- [x] 🟢 1.2 Page Contact
- [x] 🟡 1.3 Liste des catégories
- [x] 🟡 1.4 Les livres d'une catégorie
- [x] 🔴 1.5 Page 404 personnalisée
- [x] ✅ `--group=seance-01` vert

## 2️⃣ Base de données & Eloquent
- [ ] 🎓 Fiche [Migrations et relations](cours/02-eloquent-migrations.md) + auto-évaluation
- [x] 🟢 2.1 Table et modèle `Auteur`
- [x] 🟢 2.2 Remplacer la colonne `auteur` par `auteur_id` (reprise des données)
- [x] 🟡 2.3 Seeders et recherche par auteur
- [x] 🔴 2.4 Page d'un auteur
- [x] ✅ `--group=seance-02` vert

## 3️⃣ Gestion : lister et ajouter
- [ ] 🎓 Fiche [Contrôleurs resource et validation](cours/03-resource-validation.md) + auto-évaluation
- [x] 🟢 3.1 Contrôleur *resource* et liste paginée
- [x] 🟢 3.2 Formulaire d'ajout validé
- [x] 🟡 3.3 Fiche de gestion et Form Request
- [x] ✅ `--group=seance-03` vert

## 4️⃣ Gestion : modifier, supprimer
- [ ] 🎓 Fiche [Formulaires, verbes HTTP, CSRF](cours/04-formulaires-csrf.md) + auto-évaluation
- [x] 🟢 4.1 Modifier un livre
- [x] 🟢 4.2 Supprimer un livre
- [x] 🟡 4.3 Les catégories, en autonomie
- [x] 🔴 4.4 Filtres conservés dans la pagination
- [x] ✅ `--group=seance-04` vert

## 5️⃣ Authentification & rôles
- [ ] ✍️ Interrogation écrite n° 1 (séances 1 à 4)
- [ ] 🎓 Fiche [Authentification et autorisation](cours/05-authentification.md) + auto-évaluation
- [x] 🟢 5.1 Rôles, connexion, déconnexion
- [x] 🟢 5.2 Protéger l'espace de gestion
- [x] 🟡 5.3 Inscription d'un adhérent
- [x] 🟡 5.4 Durcir la connexion
- [x] ✅ `--group=seance-05` vert

## 6️⃣ Emprunts
- [ ] 🎓 Fiche [Règles de gestion et transactions](cours/06-regles-transactions.md) + auto-évaluation
- [x] 🟢 6.1 Table, modèle, relations
- [x] 🟢 6.2 Emprunter un livre
- [x] 🟡 6.3 Règles de gestion
- [x] 🟡 6.4 Mes emprunts, retour d'un livre
- [x] 🔴 6.5 Page des retards
- [x] ✅ `--group=seance-06` vert

## 7️⃣ API REST
- [ ] 🎓 Fiche [API REST](cours/07-api-rest.md) + auto-évaluation
- [x] 🟢 7.1 `GET /api/livres`
- [x] 🟢 7.2 `GET /api/livres/{livre}`
- [x] 🟡 7.3 Filtres
- [x] 🟡 7.4 Création protégée par jeton
- [x] 🔴 7.5 Obtenir un jeton
- [x] ✅ `--group=seance-07` vert

## 8️⃣ Qualité, sécurité, mise en ligne
- [ ] ✍️ Interrogation écrite n° 2 (séances 5 à 7)
- [ ] 🎓 Fiche [Qualité et mise en production](cours/08-qualite-production.md) + auto-évaluation
- [x] 🟡 8.1 Audit : trouver et corriger la faille
- [x] 🟢 8.2 Écrire vos propres tests
- [x] 🟢 8.3 Style du code (Pint) au vert
- [ ] 🟡 8.4 Mise en ligne
- [ ] 🟢 8.5 Fiche de réalisation E5
- [x] ✅ `--group=seance-08` vert, toutes les coches vertes dans **Actions**

---
🎓 fiche + auto-évaluation · 🟢 guidé · 🟡 semi-guidé · 🔴 autonome · ✅ tests · ✍️ interrogation

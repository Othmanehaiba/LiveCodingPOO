# 🎓 Application de Gestion des Bourses Étudiantes — PHP POO

## 📌 Description

Cette application permet de gérer le calcul des **bourses d’études** pour les étudiants selon :

✔ leurs revenus familiaux  
✔ leurs frais de scolarité  
✔ leurs performances académiques (étudiants méritants)  
✔ leurs frais administratifs (étudiants étrangers)

Le projet met en pratique les principes de la **Programmation Orientée Objet en PHP** :

- Encapsulation
- Héritage
- Polymorphisme
- Gestion des exceptions

---

## 🏆 Règles d’attribution de la Bourse

| Revenus Familiaux (DH) | Pourcentage de Bourse |
|-----------------------|---------------------|
| 0 à 30 000            | 100 % |
| 30 001 à 60 000       | 75 % |
| 60 001 à 100 000      | 50 % |
| 100 001 à 150 000     | 25 % |
| > 150 000             | 0 % |

> 🧮 Exemple :  
> Revenu = 45 000 DH — Frais = 12 000 DH  
> Bourse = 12 000 × 75 % = **9 000 DH**

---

## 🧱 Architecture du Projet

Le projet est composé de 5 fichiers principaux :

📌 **Classes PHP :**

| Fichier | Description |
|--------|-------------|
| `Bourse.php` | Gestion des tranches et calcul du pourcentage de bourse |
| `IEtudiant.php` | Interface définissant les méthodes obligatoires |
| `Etudiant.php` | Classe abstraite représentant un étudiant |
| `EtudiantMeritant.php` | Étudiant avec prime supplémentaire |
| `EtudiantEtranger.php` | Étudiant avec frais administratifs |

📌 **Fichier test :**

| Fichier | Description |
|--------|-------------|
| `test.php` | Permet de tester la création et l'affichage des étudiants |

---

## ⚙️ Fonctionnalités principales

### ✨ Bourse générale
- Calcul automatique selon les revenus (classe `Bourse`)

### ✨ Étudiants Méritants
- Prime fixe : **2000 DH**
- Montant final = Bourse + Prime

### ✨ Étudiants Étrangers
- Frais administratifs fixes : **5000 DH**
- Montant final = Bourse − Frais administratifs

---

## 🛡️ Gestion des erreurs

Le système vérifie que :

- L’étudiant a **au moins 16 ans** lors de son inscription  
➡️ sinon → `Exception`

- Les valeurs fournies sont valides  
➡️ sinon → `Exception`

---

## 🧪 Exemple d’utilisation

```php
$etud1 = new EtudiantMeritant("Ali", "Naji", "2002-05-10", "2021-09-06", 12000, 45000, 15.5);
$etud2 = new EtudiantEtranger("Sara", "Zhu", "2000-03-21", "2020-09-10", 14000, 30000);

echo $etud1->calculerMontantBourse();  
echo $etud2->calculerMontantBourse();

$etud1->comparerMatricule($etud2);

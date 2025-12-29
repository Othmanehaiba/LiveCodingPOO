<?php

require_once "./IEtudiant.php";
require_once "./Bource.php";

abstract class Etudiant implements IEtudiant
{
    private static int $compteur = 1;

    protected int $matricule;
    protected string $nom;
    protected string $prenom;
    protected string $dateNaissance;   // format: YYYY-MM-DD
    protected string $dateInscription; // format: YYYY-MM-DD
    protected float $fraisScolarite;
    protected float $revenusFamiliaux;

    public function __construct(string $nom = "Inconnu", string $prenom = "Inconnu", string $dateNaissance = "2000-01-01", string $dateInscription = "2020-01-01", float $fraisScolarite = 0, float $revenusFamiliaux = 0) {
        $this->matricule = self::$compteur++;
        $this->setNom($nom);
        $this->setPrenom($prenom);
        $this->setDateNaissance($dateNaissance);
        $this->setDateInscription($dateInscription);
        $this->setFraisScolarite($fraisScolarite);
        $this->setRevenusFamiliaux($revenusFamiliaux);

        // règle : âge à l'inscription >= 16
        $ageInscription = $this->calculerAgeAUneDate($this->dateInscription);
        if ($ageInscription < 16) {
            throw new Exception("Âge insuffisant à l'inscription (min 16 ans).");
        }
    }

    // =============== GETTERS ===============
    public function getMatricule(): int { return $this->matricule; }
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getDateNaissance(): string { return $this->dateNaissance; }
    public function getDateInscription(): string { return $this->dateInscription; }
    public function getFraisScolarite(): float { return $this->fraisScolarite; }
    public function getRevenusFamiliaux(): float { return $this->revenusFamiliaux; }

    // Interface: âge actuel
    public function getAge(): int
    {
        return $this->calculerAgeAUneDate(date('Y-m-d'));
    }

    // Interface: nombre d'années depuis inscription
    public function getNbAnneesInscription(): int
    {
        $dIns = new DateTime($this->dateInscription);
        $now  = new DateTime(date('Y-m-d'));
        return $dIns->diff($now)->y;
    }

    // =============== SETTERS (avec validation simple) ===============
    public function setNom(string $nom): void
    {
        $nom = trim($nom);
        if ($nom === "") {
            throw new Exception("Le nom ne peut pas être vide.");
        }
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom): void
    {
        $prenom = trim($prenom);
        if ($prenom === "") {
            throw new Exception("Le prénom ne peut pas être vide.");
        }
        $this->prenom = $prenom;
    }

    public function setDateNaissance(string $date): void
    {
        if (!$this->dateValide($date)) {
            throw new Exception("Date de naissance invalide (format attendu YYYY-MM-DD).");
        }
        $this->dateNaissance = $date;
    }

    public function setDateInscription(string $date): void
    {
        if (!$this->dateValide($date)) {
            throw new Exception("Date d'inscription invalide (format attendu YYYY-MM-DD).");
        }
        $this->dateInscription = $date;
    }

    public function setFraisScolarite(float $frais): void
    {
        if ($frais < 0) {
            throw new Exception("Les frais de scolarité ne peuvent pas être négatifs.");
        }
        $this->fraisScolarite = $frais;
    }

    public function setRevenusFamiliaux(float $revenu): void
    {
        if ($revenu < 0) {
            throw new Exception("Les revenus familiaux ne peuvent pas être négatifs.");
        }
        $this->revenusFamiliaux = $revenu;
    }

    // =============== Méthodes utiles ===============
    protected function dateValide(string $date): bool
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    protected function calculerAgeAUneDate(string $dateRef): int
    {
        $naiss = new DateTime($this->dateNaissance);
        $ref   = new DateTime($dateRef);
        return (int)$naiss->diff($ref)->y;
    }

    public function afficherProprietes(): string
    {
        return
            "Matricule: {$this->matricule}\n" .
            "Nom: {$this->nom}\n" .
            "Prénom: {$this->prenom}\n" .
            "Age: " . $this->getAge() . " ans\n" .
            "Date inscription: {$this->dateInscription}\n" .
            "Années d'inscription: " . $this->getNbAnneesInscription() . "\n" .
            "Frais scolarité: {$this->fraisScolarite} DH\n" .
            "Revenus familiaux: {$this->revenusFamiliaux} DH\n";
    }

    public function comparerMatricule(Etudiant $autreEtudiant): int
    {
        
        return $this->matricule <=> $autreEtudiant->getMatricule();
    }

    // Méthode abstraite => obliger les enfants à la redéfinir
    abstract public function calculerMontantBourse(): float;
}

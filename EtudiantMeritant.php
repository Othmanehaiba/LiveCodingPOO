<?php

require_once "./Etudiant.php";

class EtudiantMeritant extends Etudiant
{
    private float $noteMoyenne;
    private float $prime = 2000; // fixe

    public function __construct( string $nom, string $prenom, string $dateNaissance, string $dateInscription, float $fraisScolarite, float $revenusFamiliaux, float $noteMoyenne) {
        parent::__construct($nom, $prenom, $dateNaissance, $dateInscription, $fraisScolarite, $revenusFamiliaux);
        $this->setNoteMoyenne($noteMoyenne);
    }

    public function setNoteMoyenne(float $note): void
    {
        if ($note < 0 || $note > 20) {
            throw new Exception("La note moyenne doit être entre 0 et 20.");
        }
        $this->noteMoyenne = $note;
    }

    public function getNoteMoyenne(): float
    {
        return $this->noteMoyenne;
    }

    public function getPrime(): float
    {
        return $this->prime;
    }

   
    public function calculerMontantBourse(): float
    {
        $base = Bourse::calculerMontantBourse($this->fraisScolarite, $this->revenusFamiliaux);
        return $base + $this->prime;
    }

    public function afficherProprietes(): string
    {
        return parent::afficherProprietes()
            . "Type: Méritant\n"
            . "Note moyenne: {$this->noteMoyenne}/20\n"
            . "Prime: {$this->prime} DH\n";
    }
}

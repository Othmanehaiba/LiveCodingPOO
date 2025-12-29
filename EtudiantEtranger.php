<?php

require_once "./Etudiant.php";

class EtudiantEtranger extends Etudiant
{
    private float $fraisAdministratifs = 5000; // fixe

    public function getFraisAdministratifs(): float
    {
        return $this->fraisAdministratifs;
    }

    // bourse de base - frais administratifs (minimum 0)
    public function calculerMontantBourse(): float
    {
        $base = Bourse::calculerMontantBourse($this->fraisScolarite, $this->revenusFamiliaux);
        $final = $base - $this->fraisAdministratifs;

        // on évite une bourse négative
        return ($final < 0) ? 0 : $final;
    }

    public function afficherProprietes(): string
    {
        return parent::afficherProprietes()
            . "Type: Étranger\n"
            . "Frais administratifs: {$this->fraisAdministratifs} DH\n";
    }
}

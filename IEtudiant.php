<?php

interface IEtudiant
{
    public function getAge(): int;
    public function getNbAnneesInscription(): int;

    // Chaque type d'étudiant calculera sa bourse à sa manière (polymorphisme)
    public function calculerMontantBourse(): float;
}

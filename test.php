<?php

require_once "./EtudiantMeritant.php";
require_once "./EtudiantEtranger.php";
require_once "./IEtudiant.php";

echo "<pre>";

try {
    
    $e1 = new EtudiantMeritant(
        "Amine",
        "El Azzouzi",
        "2002-05-10",
        "2020-09-15",
        12000,
        45000,
        16.5
    );

    // echo "===== ETUDIANT MERITANT =====\n";
    // echo $e1->afficherProprietes();
    // echo "Bourse totale: " . $e1->calculerMontantBourse() . " DH\n\n";

    // // Etranger : revenu 45000 frais 12000 => 9000 - 5000 => 4000
    $e2 = new EtudiantEtranger(
        "Sara",
        "Benali",
        "2001-02-20",
        "2019-10-01",
        12000,
        45000
    );

    // echo "===== ETUDIANT ETRANGER =====\n";
    // echo $e2->afficherProprietes();
    // echo "Bourse totale: " . $e2->calculerMontantBourse() . " DH\n\n";

    // // Comparaison matricule
    // echo "===== COMPARAISON MATRICULE =====\n";
    // $cmp = $e1->comparerMatricule($e2);
    // if ($cmp < 0) echo "e1 a un matricule plus petit que e2\n";
    // elseif ($cmp > 0) echo "e1 a un matricule plus grand que e2\n";
    // else echo "Même matricule\n";

    // // Test exception âge < 16 à l'inscription
    // echo "\n===== TEST EXCEPTION (age < 16) =====\n";
    // $e3 = new EtudiantEtranger(
    //     "Youssef",
    //     "Test",
    //     "2010-01-01",   // trop jeune
    //     "2024-09-01",
    //     10000,
    //     20000
    // );

} catch (Exception $e) {
    echo "ERREUR: " . $e->getMessage() . "\n";
}

echo "</pre>";

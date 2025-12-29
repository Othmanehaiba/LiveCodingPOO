<?php

class Bourse
{
    public static array $revenus = [0, 30000, 60000, 100000, 150000];

    public static array $pourcentages = [100, 75, 50, 25, 0];


    public static function getPourcentageBourse(float $revenu): int{
        if ($revenu < 0) {
            throw new Exception("Le revenu ne peut pas être négatif.");
        }

        if ($revenu <= self::$revenus[1] && $revenu > self::$revenus[0]) {
            return self::$pourcentages[0];
        }

        if ($revenu <= self::$revenus[2]) {
            return self::$pourcentages[1];
        }

        if ($revenu <= self::$revenus[3]) {
            return self::$pourcentages[2];
        }

        if ($revenu <= self::$revenus[4]) {
            return self::$pourcentages[3];
        }

        return self::$pourcentages[4];
    }

    public static function calculerMontantBourse(float $frais, float $revenu): float
    {
        if ($frais < 0) {
            throw new Exception("Les frais de scolarité ne peuvent pas être négatifs.");
        }

        $p = self::getPourcentageBourse($revenu);
        return $frais * ($p / 100);
    }
}

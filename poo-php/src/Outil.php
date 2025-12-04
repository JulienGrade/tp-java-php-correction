<?php

class Outil
{
    private string $nom;
    private float $prixParJour;
    private bool $disponible;

    public function __construct(string $nom, float $prixParJour, bool $disponible = true)
    {
        $this->nom = $nom;
        $this->prixParJour = $prixParJour;
        $this->disponible = $disponible;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrixParJour(): float
    {
        return $this->prixParJour;
    }

    public function estDisponible(): bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): void
    {
        $this->disponible = $disponible;
    }

    public function __toString(): string
    {
        $status = $this->disponible ? "DISPONIBLE" : "LOUE";
        return $this->nom . " | " . $this->prixParJour . " €/jour | " . $status;
    }
}

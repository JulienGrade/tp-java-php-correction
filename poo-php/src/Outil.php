<?php

class Outil
{
    public string $nom {
        get {
            return $this->nom;
        }
    }
    public float $prixParJour {
        get {
            return $this->prixParJour;
        }
    }
    public bool $disponible {
        set {
            $this->disponible = $value;
        }
    }

    public function __construct(string $nom, float $prixParJour, bool $disponible = true)
    {
        $this->nom = $nom;
        $this->prixParJour = $prixParJour;
        $this->disponible = $disponible;
    }

    public function estDisponible(): bool
    {
        return $this->disponible;
    }

    public function __toString(): string
    {
        $status = $this->disponible ? "DISPONIBLE" : "LOUE";
        return $this->nom . " | " . $this->prixParJour . " €/jour | " . $status;
    }
}

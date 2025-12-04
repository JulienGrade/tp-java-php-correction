<?php

require_once 'Catalogue.php';

class ServiceLocation
{
    private Catalogue $catalogue;

    public function __construct(Catalogue $catalogue)
    {
        $this->catalogue = $catalogue;
    }

    /**
     * @throws LocationException
     */
    public function louerOutil(int $index, int $nbJours): float
    {
        $outil = $this->catalogue->getOutil($index);

        if (!$outil->estDisponible()) {
            throw new LocationException("Outil deja loue. Impossible de le louer a nouveau.");
        }

        if ($nbJours <= 0) {
            throw new LocationException("Le nombre de jours doit etre strictement positif.");
        }

        $prixTotal = $nbJours * $outil->prixParJour;
        $outil->disponible = false;

        return $prixTotal;
    }

    /**
     * @throws LocationException
     */
    public function retournerOutil(int $index): void
    {
        $outil = $this->catalogue->getOutil($index);

        if ($outil->estDisponible()) {
            throw new LocationException("Cet outil est deja marque comme disponible.");
        }

        $outil->disponible = true;
    }
}

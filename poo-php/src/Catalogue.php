<?php

require_once 'Outil.php';
require_once 'LocationException.php';

class Catalogue
{
    /** @var Outil[] */
    private array $outils = [];

    public function __construct()
    {
        $this->outils[] = new Outil("Perceuse", 15.0, true);
        $this->outils[] = new Outil("Ponceuse", 12.5, true);
        $this->outils[] = new Outil("Tondeuse", 25.0, true);
        $this->outils[] = new Outil("Marteau piqueur", 40.0, true);
        $this->outils[] = new Outil("Echelle", 10.0, true);
    }

    public function taille(): int
    {
        return count($this->outils);
    }

    /**
     * @throws LocationException
     */
    public function getOutil(int $index): Outil
    {
        if ($index < 0 || $index >= count($this->outils)) {
            throw new LocationException("Aucun outil pour cet index.");
        }
        return $this->outils[$index];
    }

    public function afficherOutils(): void
    {
        echo "\nListe des outils :\n";
        foreach ($this->outils as $index => $outil) {
            echo $index . " - " . $outil . PHP_EOL;
        }
        echo "\n";
    }
}



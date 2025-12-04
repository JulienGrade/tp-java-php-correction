<?php

require_once 'Catalogue.php';
require_once 'ServiceLocation.php';
require_once 'LocationException.php';

class Application
{
    private Catalogue $catalogue;
    private ServiceLocation $serviceLocation;
    private bool $quit = false;

    public function __construct()
    {
        $this->catalogue = new Catalogue();
        $this->serviceLocation = new ServiceLocation($this->catalogue);
    }

    /**
     * Point d'entrée de l'application console.
     */
    public function run(): void
    {
        while (!$this->quit) {
            $this->afficherMenu();

            $choiceLine = $this->readLineInput("Votre choix : ");
            if (!ctype_digit($choiceLine)) {
                echo "Choix invalide.\n\n";
                continue;
            }
            $choice = (int)$choiceLine;

            try {
                switch ($choice) {
                    case 1:
                        $this->catalogue->afficherOutils();
                        break;

                    case 2:
                        $this->gererLocation();
                        break;

                    case 3:
                        $this->gererRetour();
                        break;

                    case 4:
                        $this->quit = true;
                        echo "Au revoir !\n";
                        break;

                    default:
                        echo "Choix invalide.\n\n";
                }
            } catch (LocationException $e) {
                echo $e->getMessage() . "\n\n";
            } catch (\Exception $e) {
                echo "Erreur inattendue : " . $e->getMessage() . "\n\n";
            }
        }
    }

    /**
     * Affiche le menu principal.
     */
    private function afficherMenu(): void
    {
        echo "=====================================\n";
        echo "   Mini systeme de location d'outils \n";
        echo "=====================================\n";
        echo "1. Lister les outils\n";
        echo "2. Louer un outil\n";
        echo "3. Retourner un outil\n";
        echo "4. Quitter\n";
    }

    /**
     * Lit une ligne sur STDIN avec un prompt.
     */
    private function readLineInput(string $prompt): string
    {
        echo $prompt;
        $line = fgets(STDIN);
        if ($line === false) {
            return "";
        }
        return trim($line);
    }

    /**
     * Gère le cas "Louer un outil".
     * @throws LocationException
     */
    private function gererLocation(): void
    {
        $indexLine = $this->readLineInput("\nEntrez l'index de l'outil a louer : ");
        if (!ctype_digit($indexLine)) {
            echo "Index invalide.\n\n";
            return;
        }
        $index = (int)$indexLine;

        $daysLine = $this->readLineInput("Nombre de jours de location : ");
        if (!ctype_digit($daysLine)) {
            echo "Nombre de jours invalide.\n\n";
            return;
        }
        $days = (int)$daysLine;

        $totalPrice = $this->serviceLocation->louerOutil($index, $days);
        $outil = $this->catalogue->getOutil($index);

        echo "\n---------- Recapitulatif ----------\n";
        echo "Outil : " . $outil->nom . "\n";
        echo "Duree : " . $days . " jour(s)\n";
        echo "Prix par jour : " . $outil->prixParJour . " €\n";
        echo "Prix total : " . $totalPrice . " €\n";
        echo "-----------------------------------\n\n";
    }

    /**
     * Gère le cas "Retourner un outil".
     * @throws LocationException
     */
    private function gererRetour(): void
    {
        $indexLine = $this->readLineInput("\nEntrez l'index de l'outil a retourner : ");
        if (!ctype_digit($indexLine)) {
            echo "Index invalide.\n\n";
            return;
        }
        $index = (int)$indexLine;

        $this->serviceLocation->retournerOutil($index);
        $outil = $this->catalogue->getOutil($index);
        echo "Outil " . $outil->nom . " retourne. Il est maintenant disponible.\n\n";
    }
}

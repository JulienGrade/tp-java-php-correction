<?php

require_once 'Catalogue.php';
require_once 'ServiceLocation.php';

function readLineInput(string $prompt): string
{
    echo $prompt;
    $line = fgets(STDIN);
    if ($line === false) {
        return "";
    }
    return trim($line);
}

$catalogue = new Catalogue();
$serviceLocation = new ServiceLocation($catalogue);

$quit = false;

while (!$quit) {
    echo "=====================================\n";
    echo "   Mini systeme de location d'outils \n";
    echo "=====================================\n";
    echo "1. Lister les outils\n";
    echo "2. Louer un outil\n";
    echo "3. Retourner un outil\n";
    echo "4. Quitter\n";

    $choiceLine = readLineInput("Votre choix : ");
    if (!ctype_digit($choiceLine)) {
        echo "Choix invalide.\n\n";
        continue;
    }
    $choice = (int)$choiceLine;

    try {
        if ($choice === 1) {
            $catalogue->afficherOutils();

        } elseif ($choice === 2) {
            $indexLine = readLineInput("\nEntrez l'index de l'outil a louer : ");
            if (!ctype_digit($indexLine)) {
                echo "Index invalide.\n\n";
                continue;
            }
            $index = (int)$indexLine;

            $daysLine = readLineInput("Nombre de jours de location : ");
            if (!ctype_digit($daysLine)) {
                echo "Nombre de jours invalide.\n\n";
                continue;
            }
            $days = (int)$daysLine;

            $totalPrice = $serviceLocation->louerOutil($index, $days);
            $outil = $catalogue->getOutil($index);

            echo "\n---------- Recapitulatif ----------\n";
            echo "Outil : " . $outil->getNom() . "\n";
            echo "Duree : " . $days . " jour(s)\n";
            echo "Prix par jour : " . $outil->getPrixParJour() . " €\n";
            echo "Prix total : " . $totalPrice . " €\n";
            echo "-----------------------------------\n\n";

        } elseif ($choice === 3) {
            $indexLine = readLineInput("\nEntrez l'index de l'outil a retourner : ");
            if (!ctype_digit($indexLine)) {
                echo "Index invalide.\n\n";
                continue;
            }
            $index = (int)$indexLine;

            $serviceLocation->retournerOutil($index);
            $outil = $catalogue->getOutil($index);
            echo "Outil " . $outil->getNom() . " retourne. Il est maintenant disponible.\n\n";

        } elseif ($choice === 4) {
            $quit = true;
            echo "Au revoir !\n";
        } else {
            echo "Choix invalide.\n\n";
        }
    } catch (LocationException $e) {
        echo $e->getMessage() . "\n\n";
    } catch (Exception $e) {
        echo "Erreur inattendue : " . $e->getMessage() . "\n\n";
    }
}

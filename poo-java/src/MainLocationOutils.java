import java.util.Scanner;

public class MainLocationOutils {

    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);
        Catalogue catalogue = new Catalogue();
        ServiceLocation serviceLocation = new ServiceLocation(catalogue);

        boolean quitter = false;

        while (!quitter) {
            System.out.println("=====================================");
            System.out.println("   Mini systeme de location d'outils ");
            System.out.println("=====================================");
            System.out.println("1. Lister les outils");
            System.out.println("2. Louer un outil");
            System.out.println("3. Retourner un outil");
            System.out.println("4. Quitter");
            System.out.print("Votre choix : ");

            String ligne = scanner.nextLine();
            int choix;
            try {
                choix = Integer.parseInt(ligne);
            } catch (NumberFormatException e) {
                System.out.println("Choix invalide.\n");
                continue;
            }

            try {
                switch (choix) {
                    case 1:
                        catalogue.afficherOutils();
                        break;

                    case 2:
                        System.out.print("\nEntrez l'index de l'outil a louer : ");
                        String indexStr = scanner.nextLine();
                        int indexLouer = Integer.parseInt(indexStr);

                        System.out.print("Nombre de jours de location : ");
                        String joursStr = scanner.nextLine();
                        int nbJours = Integer.parseInt(joursStr);

                        double prixTotal = serviceLocation.louerOutil(indexLouer, nbJours);
                        Outil outilLoue = catalogue.getOutil(indexLouer);

                        System.out.println("\n---------- Recapitulatif ----------");
                        System.out.println("Outil : " + outilLoue.getNom());
                        System.out.println("Duree : " + nbJours + " jour(s)");
                        System.out.println("Prix par jour : " + outilLoue.getPrixParJour() + " €");
                        System.out.println("Prix total : " + prixTotal + " €");
                        System.out.println("-----------------------------------\n");
                        break;

                    case 3:
                        System.out.print("\nEntrez l'index de l'outil a retourner : ");
                        String indexRetourStr = scanner.nextLine();
                        int indexRetour = Integer.parseInt(indexRetourStr);

                        serviceLocation.retournerOutil(indexRetour);
                        Outil outilRetourne = catalogue.getOutil(indexRetour);
                        System.out.println("Outil " + outilRetourne.getNom()
                                + " retourne. Il est maintenant disponible.\n");
                        break;

                    case 4:
                        quitter = true;
                        System.out.println("Au revoir !");
                        break;

                    default:
                        System.out.println("Choix invalide.\n");
                }
            } catch (NumberFormatException e) {
                System.out.println("Valeur numerique invalide.\n");
            } catch (LocationException e) {
                System.out.println(e.getMessage() + "\n");
            }
        }

        scanner.close();
    }
}

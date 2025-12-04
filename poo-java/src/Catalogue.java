import java.util.ArrayList;
import java.util.List;

public class Catalogue {

    private final List<Outil> outils = new ArrayList<>();

    public Catalogue() {
        outils.add(new Outil("Perceuse", 15.0, true));
        outils.add(new Outil("Ponceuse", 12.5, true));
        outils.add(new Outil("Tondeuse", 25.0, true));
        outils.add(new Outil("Marteau piqueur", 40.0, true));
        outils.add(new Outil("Echelle", 10.0, true));
    }

    public int taille() {
        return outils.size();
    }

    public Outil getOutil(int index) throws LocationException {
        if (index < 0 || index >= outils.size()) {
            throw new LocationException("Aucun outil pour cet index.");
        }
        return outils.get(index);
    }

    public void afficherOutils() {
        System.out.println("\nListe des outils :");
        for (int i = 0; i < outils.size(); i++) {
            System.out.println(i + " - " + outils.get(i).toString());
        }
        System.out.println();
    }
}

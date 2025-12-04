public class ServiceLocation {

    private final Catalogue catalogue;

    public ServiceLocation(Catalogue catalogue) {
        this.catalogue = catalogue;
    }

    public double louerOutil(int index, int nbJours) throws LocationException {
        Outil outil = catalogue.getOutil(index);

        if (!outil.isDisponible()) {
            throw new LocationException("Outil deja loue. Impossible de le louer a nouveau.");
        }

        if (nbJours <= 0) {
            throw new LocationException("Le nombre de jours doit etre strictement positif.");
        }

        double prixTotal = nbJours * outil.getPrixParJour();
        outil.setDisponible(false);
        return prixTotal;
    }

    public void retournerOutil(int index) throws LocationException {
        Outil outil = catalogue.getOutil(index);

        if (outil.isDisponible()) {
            throw new LocationException("Cet outil est deja marque comme disponible.");
        }

        outil.setDisponible(true);
    }
}

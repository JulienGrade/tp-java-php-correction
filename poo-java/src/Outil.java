public class Outil {
    private String nom;
    private double prixParJour;
    private boolean disponible;

    public Outil(String nom, double prixParJour, boolean disponible) {
        this.nom = nom;
        this.prixParJour = prixParJour;
        this.disponible = disponible;
    }

    public String getNom() {
        return nom;
    }

    public double getPrixParJour() {
        return prixParJour;
    }

    public boolean isDisponible() {
        return disponible;
    }

    public void setDisponible(boolean disponible) {
        this.disponible = disponible;
    }

    @Override
    public String toString() {
        return nom + " | " + prixParJour + " €/jour | " + (disponible ? "DISPONIBLE" : "LOUE");
    }
}

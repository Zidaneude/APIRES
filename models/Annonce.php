<?php

class Annonce
{
    // Toutes les méthodes et propriétés nécessaires à la gestion des données de la tables Appartement
    public $table = "appartements";
    public $connexion = null;
    // Les propritées de l'objet locataire
   public $id;
   public $ville;
   public $quatier;
   public $code_postal;
   public $description;
   public $nbre_de_chambre;
   public $nbre_de_sallebain;
}
?>
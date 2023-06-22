<?php
class Logement
{
    // Toutes les méthodes et propriétés nécessaires à la gestion des données de la tables Logement
    public $table = "logements";
    public $connexion = null;

    // Les propritées de l'objet locataire
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $sexe;
    public $telephone;
}
?>
<?php
class Offre
{
       // Toutes les méthodes et propriétés nécessaires à la gestion des données de la tables Offre
       public $table = "offres";
       public $connexion = null;
   
       // Les propritées de l'objet locataire
       public $id;
       public $disponibilite;
       public $prix;
       public $id_logegment;
       public $id_propreitaire;
       public $id_admin;
}

?>
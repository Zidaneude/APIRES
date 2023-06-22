<?php
class Reservation
{
       // Toutes les méthodes et propriétés nécessaires à la gestion des données de la tablesReservation
       public $table = "reservations";
       public $connexion = null;
   
       // Les propritées de l'objet locataire
       public $id;
       public $date;
       public $heure;
       public $status;
       public $id_locataire;
       public $id_chambre;
       public $id_appartement;

}

?>
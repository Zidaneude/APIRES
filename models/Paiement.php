<?php
class Paiement
{
     // Toutes les méthodes et propriétés nécessaires à la gestion des données de la tables Paiement
     public $table = "paiements";
     public $connexion = null;
 
     // Les propritées de l'objet locataire
     public $id;
     public $montant;
     public $mode;
     public $date;
     public $heure;
     public $status;
     public $id_reservation;
     
     public function __construct($db)
     {
         if ($this->connexion == null)
         {
                 $this->connexion = $db;
         }
     }
     public function readAll(){
         // On ecrit la requete
         $sql = "SELECT id,nom,prenom,email,sexe,telephone FROM $this->table ";
          // On éxecute la requête
          $req = $this->connexion->query($sql);
  
          // On retourne le resultat
          return $req;
      }
 
      public function create()
     {
         $sql = "INSERT INTO $this->table(nom,prenom,email,sexe,telephone,mdp) VALUES(:nom,:prenom,:email,:sexe,mdp)";
 
         // Préparation de la réqête
         $req = $this->connexion->prepare($sql);
 
         // éxecution de la reqête
         $re = $req->execute([
             ":nom" => $this->nom,
             ":prenom" => $this->prenom,
             ":email" => $this->email,
             ":sexe" => $this->sexe,
             ":telephone" => $this->telephone,
             ":mdp" => $this->mdp
         ]);
         if ($re) {
             return true;
         } else {
             return false;
         }
     }
     public function update()
     {
         $sql = "UPDATE $this->table SET nom=:nom, prenom=:prenom, email=:email, sexe=: sexe,telephone:=telephone,mdp:=mdp WHERE id=:id";
 
         // Préparation de la réqête
         $req = $this->connexion->prepare($sql);
 
         // éxecution de la reqête
         $re = $req->execute([
             ":nom" => $this->nom,
             ":prenom" => $this->prenom,
             ":email" => $this->email,
             ":sexe" => $this->sexe,
             ":telephone" => $this->telephone,
             ":mdp" => $this->mdp
         ]);
         if ($re) {
             return true;
         } else {
             return false;
         }
     }
     public function delete()
     {
         $sql = "DELETE FROM $this->table WHERE id = :id";
         $req = $this->connexion->prepare($sql);
 
         $re = $req->execute(array(":id" => $this->id));
 
         if ($re) {
             return true;
         } else {
             return false;
         }
     }
}

?>
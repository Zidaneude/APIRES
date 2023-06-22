<?php

class Equipement
{
     // Toutes les méthodes et propriétés nécessaires à la gestion des données de la tables Equipement
     public $table = "equipements";
     public $connexion = null;
 
     // Les propritées de l'objet locataire
     public $id;
     public $non;

     public function __construct($db)
    {
        if ($this->connexion == null)
        {
                $this->connexion = $db;
        }
    }

    public function readAll(){
        // On ecrit la requete
        $sql = "SELECT * FROM $this->table ";
         // On éxecute la requête
         $req = $this->connexion->query($sql);
 
         // On retourne le resultat
         return $req;
     }


     public function create()
    {
        $sql = "INSERT INTO $this->table(nom) VALUES(:nom)";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
            ":nom" => $this->nom,
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }
    public function update()
    {
        $sql = "UPDATE $this->table SET nom=:nom WHERE id=:id";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
            ":id"=>$this->id,
            ":nom" => $this->nom
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
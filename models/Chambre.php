<?php
class Chambre
{
     // Toutes les méthodes et propriétés nécessaires à la gestion des données de la tables Chambre
     public $table = "chambres";
     public $connexion = null;
     // Les propritées de l'objet locataire
    public $id;
    public $ville;
    public $quatier;
    public $code_postal;
    public $description;
    public $nbre_de_lit;
    public $chemin_photo1;
    public $chemin_photo2;
    public $chemin_photo3;

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
        $sql = "INSERT INTO $this->table(ville,code_postal,quatier,description,nbre_de_lit,chemin_photo1,chemin_photo2,chemin_photo3) VALUES(:ville,:code_postal,:quatier,:description,:nbre_de_lit,:chemin_photo1,:chemin_photo2,:chemin_photo3)";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
            ":ville" => $this->nom,
            ":code_postal" => $this->prenom,
            ":quatier" => $this->quatier,
            ":description" => $this->description,
            ":nbre_de_lit" => $this->nbre_de_lit,
            ":chemin_photo1" => $this->chemin_photo1,
            ":chemin_photo2" => $this->chemin_photo2,
            ":chemin_photo3" => $this->chemin_photo3
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }
    public function update()
    {
        $sql = "UPDATE $this->table SET ville=:ville, code_postal=:code_postal, quatier=:quatier, description=: description,nbre_de_lit:=nbre_de_lit,chemin_photo1:=chemin_photo1,chemin_photo2:=chemin_photo2,chemin_photo3:=chemin_photo3 WHERE id=:id";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
            ":ville" => $this->nom,
            ":code_postal" => $this->prenom,
            ":quatier" => $this->quatier,
            ":description" => $this->description,
            ":nbre_de_lit" => $this->nbre_de_lit,
            ":chemin_photo1" => $this->chemin_photo1,
            ":chemin_photo2" => $this->chemin_photo2,
            ":chemin_photo3" => $this->chemin_photo3
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
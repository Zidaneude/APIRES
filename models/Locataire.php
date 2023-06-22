<?php
 class Locataire
 {
    // Toutes les méthodes et propriétés nécessaires à la gestion des données de la tables locataire
    public $table = "locataires";
    public $connexion = null;

    // Les propritées de l'objet locataire
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $sexe;
    public $telephone;
    public $mdp;

    //constructeur
    public function __construct($db)
    {
        if ($this->connexion == null)
        {
                $this->connexion = $db;
        }
    }

    //recupére tous les locataire
    public function readAll(){
        // On ecrit la requete
        $sql = "SELECT *FROM $this->table ";
         // On éxecute la requête
         $req = $this->connexion->query($sql);
 
         // On retourne le resultat
         return $req;
     }

     //enregistrer un nouveau locataire
     public function create()
    {
        $sql = "INSERT INTO $this->table(nom,prenom,email,sexe,telephone,mdp) VALUES(:nom,:prenom,:email,:sexe,:telephone,:mdp)";

        $checkLocataire="SELECT * FROM $this->table WHERE email=:email ";
        $stmt = $this->connexion->prepare($checkLocataire);
        $stmt->execute([":email" => $this->email]);
        $rows = $stmt->fetchAll();
        if(count($rows)==0)
        {
            $req = $this->connexion->prepare($sql);

            // éxecution de la reqête
            $re = $req->execute([
                ":nom" => $this->nom,
                ":prenom" => $this->prenom,
                ":email" => $this->email,
                ":sexe" => $this->sexe,
                ":telephone" => $this->telephone,
                ":mdp" =>password_hash($this->mdp,PASSWORD_BCRYPT,['cost'=>12])
            ]);
            if ($re) {
                return 1;
            } else {
                return 2;
            }
        }
        else
        {
            return 3;
        }
        
       
    }
    //mettre a jour 
    public function update()
    {
        $sql = "UPDATE $this->table SET nom=:nom, prenom=:prenom, email=:email, sexe=:sexe,telephone=:telephone,mdp=:mdp WHERE id=:id";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
            ":id" => $this->id,
            ":nom" => $this->nom,
            ":prenom" => $this->prenom,
            ":email" => $this->email,
            ":sexe" => $this->sexe,
            ":telephone" => $this->telephone,
            ":mdp" =>password_hash($this->mdp,PASSWORD_BCRYPT,['cost'=>12])
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }
    //supprimer
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
    //
    function getLocataire($id)
    {
       
        $query="SELECT * FROM $this->table";
        if($id != 0)
        {
            $query .= " WHERE id=".$id." LIMIT 1";
        }
        $result=$this->connexion->query($query);
        $reponse=array();
        while ($row=$result->fetch()) {

            //array_push($reponse, $row);
            echo json_encode($row, JSON_PRETTY_PRINT);
        }
        //header('Content-Type: application/json');
	    //echo json_encode($reponse, JSON_PRETTY_PRINT);
    }
    public function setNom($email,$nom)
    {
        $sql = "UPDATE $this->table SET nom=:nom WHERE email=:email";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
           
            ":nom" => $nom,
            ":email" => $email
    
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }

     public function setPrenom($email,$prenom)
    {
        $sql = "UPDATE $this->table SET prenom=:prenom WHERE email=:email";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
           
            ":prenom" => $prenom,
            ":email" => $email
    
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }
    public function setTelephone($email)
    {
        $sql = "UPDATE $this->table SET telephone=:telephone WHERE email=:email";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
           
            ":telephone" => $this->nom,
            ":email" => $this->email
    
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }
    public function setSexe($email)
    {
        $sql = "UPDATE $this->table SET sexe=:sexe WHERE email=:email";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
           
            ":sexe" => $this->nom,
            ":email" => $this->email
    
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }
     public function setNationalte($email)
    {
        $sql = "UPDATE $this->table SET nationalte=:nationalte WHERE email=:email";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
           
            ":nationalte" => $this->nom,
            ":email" => $this->email
    
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }
    public function setDateN($email)
    {
        $sql = "UPDATE $this->table SET date_nais=:date_nais WHERE email=:email";

        // Préparation de la réqête
        $req = $this->connexion->prepare($sql);

        // éxecution de la reqête
        $re = $req->execute([
           
            ":date_nais" => $this->nom,
            ":email" => $this->email
    
        ]);
        if ($re) {
            return true;
        } else {
            return false;
        }
    }
 
    
 }

?>
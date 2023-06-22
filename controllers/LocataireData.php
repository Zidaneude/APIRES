<?php
    // Les entêtes requises
    header("Access-Control-Allow-Origin: *");
    header("Content-type: application/json; charset= UTF-8");

    require_once '../config/Database.php';
    require_once '../models/Locataire.php';


    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();

    // On instancie l'objet etudiant
    $locataire = new Locataire($db);
    $request_method=$_SERVER['REQUEST_METHOD'];
    // On récupère les infos envoyées

    $data = json_decode(file_get_contents("php://input"));
    $id_operation=0;
    if($request_method=="POST")
    {
        $id_operation=$data->op;
        
        switch( $id_operation)
        {
            case 1:
                $email=$data->email;
                $nom=$data->nom;
                $result=$locataire->setNom($email,$nom);
                if($result)
                {
                    echo json_encode(['message' => "nom a été modifié avec sucès"]);
                }else
                {
                    echo json_encode(['message' => "erreur"]);
                }
                break;
            case 2:
                $email=$data->email;
                $prenom=$data->prenom;
                $result=$locataire->setPrenom($email,$prenom);
                if($result)
                {
                    echo json_encode(['message' => "prenom a été modifié avec sucès"]);
                }else
                {
                    echo json_encode(['message' => "erreur"]);
                }
                break;   
        }
    }

?>
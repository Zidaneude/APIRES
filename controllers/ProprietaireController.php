<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");

require_once '../config/Database.php';
require_once '../models/Proprietaire.php';


 // On instancie la base de données
 $database = new Database();
 $db = $database->getConnexion();

 // On instancie l'objet etudiant
 $proprietaire = new Proprietaire($db);

 $request_method=$_SERVER['REQUEST_METHOD'];


 switch($request_method)
 {
    case 'GET':
			
        if(!empty($_GET["id"]))
        {
            $id=intval($_GET["id"]);
            $proprietaire->getproprietaire($id);
        }
        else
        {
            // Récupération des données
            $statement = $proprietaire->readAll();

            if ($statement->rowCount() > 0) {
                $data = [];

                //$data[] = $statement->fetchAll();
                $reponse=array();
                while ($raw=$statement->fetch()) {
                        array_push($reponse, $raw);
                    }

                // on renvoie ses données sous format json
                //http_response_code(200);
                //echo json_encode($data);
                header('Content-Type: application/json');
                echo json_encode($reponse);
            } else {
                echo json_encode(["message" => "Aucune données à renvoyer"]);
            }
        }
        break;
    
    case 'POST':
       
        // On récupère les infos envoyées

        $data = json_decode(file_get_contents("php://input"));
        if (!empty($data->nom) && !empty($data->prenom) && !empty($data->email) && !empty($data->sexe) && !empty($data->telephone)&& !empty($data->mdp)) 
        {
            $proprietaire->nom = htmlspecialchars($data->nom);
            $proprietaire->prenom = htmlspecialchars($data->prenom);
            $proprietaire->email = htmlspecialchars($data->email);
            $proprietaire->sexe= htmlspecialchars($data->sexe);
            $proprietaire->telephone= htmlspecialchars($data->telephone);
            $proprietaire->mdp= htmlspecialchars($data->mdp);

            $result = $proprietaire->create();
            if ($result) {
                http_response_code(201);
                echo json_encode(['message' => "sucess"]);
            } else {
                http_response_code(503);
                echo json_encode(['message' => "failed"]);
            }
        } else {
            echo json_encode(['message' => "Les données ne sont au complet"]);
        }
        break;

    case'DELETE':
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id)) {
            $proprietaire->id = $data->id;
            if ($proprietaire->delete()) {
                http_response_code(200);
                echo json_encode(array("message" => "La suppression a été éffectué avec sucèss"));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "La suppression n'a été éffectué"));
            }
        } else {
            echo json_encode(['message' => "Vous devez precisé l'identifiant de proprietaire"]);
        } 

    case'PUT':   
         // On récupère les infos envoyées
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id) && !empty($data->nom) && !empty($data->prenom) && !empty($data->email) && !empty($data->sexe) && !empty($data->telephone) && !empty($data->mdp))  {
        // On hydrate l'objet etudiant
        $proprietaire->id=htmlspecialchars($data->id);
        $proprietaire->nom = htmlspecialchars($data->nom);
        $proprietaire->prenom = htmlspecialchars($data->prenom);
        $proprietaire->email = htmlspecialchars($data->email);
        $proprietaire->sexe= htmlspecialchars($data->sexe);
        $proprietaire->telephone= htmlspecialchars($data->telephone);
        $proprietaire->mdp= htmlspecialchars($data->mdp);

        $result = $proprietaire->update();
        if ($result) {
            http_response_code(201);
            echo json_encode(['message' => "proprietaire a été modifié avec sucès"]);
        } else {
            http_response_code(503);
            echo json_encode(['message' => "La modification du proprietaire a échoué"]);
        }
    } else {
        echo json_encode(['message' => "Les données ne sont au complet"]);
    } 
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    
 }


?>
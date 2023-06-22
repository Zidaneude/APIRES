<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");

require_once '../config/Database.php';
require_once '../models/Equipement.php';


 // On instancie la base de données
 $database = new Database();
 $db = $database->getConnexion();

 // On instancie l'objet etudiant
 $equipement = new equipement($db);

 $request_method=$_SERVER['REQUEST_METHOD'];

 switch($request_method)
 {
    case 'GET':
			
        if(!empty($_GET["id"]))
        {
            $id=intval($_GET["id"]);
            $equipement->getequipement($id);
        }
        else
        {
            // Récupération des données
            $statement = $equipement->readAll();

            if ($statement->rowCount() > 0) {
                $data = [];

                $data[] = $statement->fetchAll();


                // on renvoie ses données sous format json
                http_response_code(200);
                echo json_encode($data);
            } else {
                echo json_encode(["message" => "Aucune données à renvoyer"]);
            }
        }
        break;
    
    case 'POST':
     {
        // On récupère les infos envoyées
        $data = json_decode(file_get_contents("php://input"));
        if (!empty($data->nom)) {
            // On hydrate l'objet etudiant
            $equipement->nom = htmlspecialchars($data->nom);
            $result = $equipement->create();
            if ($result) {
                http_response_code(201);
                echo json_encode(['status' => "sucess"]);
            } else {
                http_response_code(503);
                echo json_encode(['status' => "failed"]);
            }
        } else {
            echo json_encode(['message' => "Les données ne sont au complet"]);
        }
        break;
     }  
    case'DELETE':
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id)) {
            $equipement->id = $data->id;
            if ($equipement->delete()) {
                http_response_code(200);
                echo json_encode(array("status" => "sucess"));
            } else {
                http_response_code(503);
                echo json_encode(array("status" => "failed"));
            }
        } else {
            echo json_encode(['message' => "Vous devez precisé l'identifiant de equipement"]);
        } 

    case'PUT':   
         // On récupère les infos envoyées
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id) && !empty($data->nom) )  {
        // On hydrate l'objet etudiant
        $equipement->id=htmlspecialchars($data->id);
        $equipement->nom = htmlspecialchars($data->nom);

        $result = $equipement->update();
        if ($result) {
            http_response_code(201);
            echo json_encode(['status' => "sucess"]);
        } else {
            http_response_code(503);
            echo json_encode(['status' => "failled"]);
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
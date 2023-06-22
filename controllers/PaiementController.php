<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");

require_once '../config/Database.php';
require_once '../models/Paiement.php';


 // On instancie la base de données
 $database = new Database();
 $db = $database->getConnexion();

 // On instancie l'objet etudiant
 $admin = new admin($db);

 $request_method=$_SERVER['REQUEST_METHOD'];

 switch($request_method)
 {
    case 'GET':
			
        if(!empty($_GET["id"]))
        {
            $id=intval($_GET["id"]);
            $admin->getadmin($id);
        }
        else
        {
            // Récupération des données
            $statement = $admin->readAll();

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
       
        // On récupère les infos envoyées

        $data = json_decode(file_get_contents("php://input"));
        if (!empty($data->nom) && !empty($data->prenom) && !empty($data->email) && !empty($data->sexe) && !empty($data->telephone)&& !empty($data->mdp)) {
            // On hydrate l'objet etudiant

            $admin->nom = htmlspecialchars($data->nom);
            $admin->prenom = htmlspecialchars($data->prenom);
            $admin->email = htmlspecialchars($data->email);
            $admin->sexe= htmlspecialchars($data->sexe);
            $admin->telephone= htmlspecialchars($data->telephone);
            $admin->mdp= htmlspecialchars($data->mdp);

            $result = $admin->create();
            if ($result) {
                http_response_code(201);
                echo json_encode(['status' => " sucess"]);
            } else {
                http_response_code(503);
                echo json_encode(['status' => "failed"]);
            }
        } else {
            echo json_encode(['message' => "Les données ne sont au complet"]);
        }
        break;

    case'DELETE':
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id)) {
            $admin->id = $data->id;
            if ($admin->delete()) {
                http_response_code(200);
                echo json_encode(array("message" => "sucess"));
            } else {
                http_response_code(503);
                echo json_encode(array("message" => "failed"));
            }
        } else {
            echo json_encode(['message' => "Vous devez precisé l'identifiant de admin"]);
        } 

    case'PUT':   
         // On récupère les infos envoyées
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id) && !empty($data->nom) && !empty($data->prenom) && !empty($data->email) && !empty($data->sexe) && !empty($data->telephone) && !empty($data->mdp))  {
        // On hydrate l'objet etudiant
        $admin->id=htmlspecialchars($data->id);
        $admin->nom = htmlspecialchars($data->nom);
        $admin->prenom = htmlspecialchars($data->prenom);
        $admin->email = htmlspecialchars($data->email);
        $admin->sexe= htmlspecialchars($data->sexe);
        $admin->telephone= htmlspecialchars($data->telephone);
        $admin->mdp= htmlspecialchars($data->mdp);

        $result = $admin->update();
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
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
    
 }


?>
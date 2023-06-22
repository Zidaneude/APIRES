<?php
require_once '../config/Database.php';

    // On instancie la base de données
    $database = new Database();
    $db = $database->getConnexion();


   $data = json_decode(file_get_contents("php://input"));
    

    $stmt = $db->prepare("SELECT * FROM propreitaires WHERE email=:email");
    $stmt->execute([":email" => $data->email]);
    $rows = $stmt->fetchAll();
  
    if (count($rows) > 0) {
        foreach ($rows as $row) {
            if (password_verify($data->mdp, $row['mdp'])) {
                echo json_encode(['message' => "sucess"]);
            }
            else
            {
                echo json_encode(['message' => "mot de pass incorrect"]);
            }
        }
    }
    else
    {
        echo json_encode(['message' => "email  ou mot de passe incorrect"]);
    }


?>
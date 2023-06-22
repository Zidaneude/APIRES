<?php

 require_once '../config/Database.php';
 header("Access-Control-Allow-Origin: *");
 header("Content-type: application/json; charset= UTF-8");


    $data = json_decode(file_get_contents("php://input"));
    $database = new Database();
    $db = $database->getConnexion();

    $stmt = $db->prepare("SELECT * FROM locataires WHERE email=:email");
    $stmt->execute([":email" => $data->email]);
    //$rows = $stmt->fetchAll();
    $row = $stmt->fetch();
    $reponse=array();
   // if (count($rows) > 0) 
   if ($row && password_verify($data->mdp, $row['mdp'])) 
    {
        $reponse=$row;
        echo json_encode( $reponse);
        //echo json_encode(['message' => "Connexion réussie"]);
        //return json_encode($response);
         /*   
        foreach ($rows as $row) {
            if (password_verify($data->mdp, $row['mdp'])) {
                //$reponse["locataire"] = $row;
                //$reponse["message"] = "success";
                //header('Content-Type: application/json');
                echo json_encode(['message' => "success"]);
                //echo json_encode($reponse);
                exit; // Terminer le script après avoir envoyé la réponse
            } else {
            
                header('Content-Type: application/json');
                $reponse["locataire"] = (object)[];
                $reponse["message"] = "Mot de passe incorrect";
                echo json_encode(['message' => "Mot de passe incorrect"]);
            // echo json_encode($reponse);
                exit; // Terminer le script après avoir envoyé la réponse
            }
        }*/

} else {
/*
    $reponse["locataire"] = (object)[];
    $reponse["message"] = "Email ou mot de passe incorrect";
   //echo json_encode($reponse);*/
   $reponse=(object)[];
    echo json_encode($reponse);
    exit; // Terminer le script après avoir envoyé la réponse
}



?>
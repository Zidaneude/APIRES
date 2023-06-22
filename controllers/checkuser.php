<?php
require_once 'db_functions.php';
$db =new DB_Functions();
$request_method=$_SERVER['REQUEST_METHOD'];

$response=array();
$data = json_decode(file_get_contents("php://input"));

$email=$data->email;
$mdp=$data->mdp;

if($request_method=='POST')
{

    if(!empty($email) &&!empty($mdp))
    {
       
        if($db->checkExistsUser($email,$mdp))
        {
          $response["exists"]=TRUE;
          echo json_encode($response);  
        }
        else
        {
            $response["exists"]=FALSE;
            echo json_encode($response);
        }
    }
    else
    {
        $response["error_msg"]="Required Parameter (email) is missing!";
        echo json_encode($response);
    }
}



?>
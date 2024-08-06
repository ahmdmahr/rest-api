<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allowed-Methods: DELETE');



  include '../../config/Database.php';
  include '../../models/Blog.php';

  // Init DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Init blog object
  $blog = new Blog($db);

  // Get blog data  
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update   
  $blog->id = $data->id;


  // Delete blog  
  if($blog->delete()){
      echo json_encode(
          ['message' => 'Blog Deleted']
      );
  }
  else{
    echo json_encode(
        ['message' => 'Blog Not Deleted']
    );
  }

?> 


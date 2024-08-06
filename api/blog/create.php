<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allowed-Methods: PUT');



  include '../../config/Database.php';
  include '../../models/Blog.php';

  // Init DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Init blog object
  $blog = new Blog($db);

  // Get blog data  
  $data = json_decode(file_get_contents("php://input"));

  $blog->id = $data->id;
  $blog->title = $data->title;
  $blog->body = $data->body;
  $blog->author = $data->author;
  $blog->category_id = $data->category_id;

  // Create blog  
  if($blog->create()){
      echo json_encode(
          ['message' => 'Blog Created']
      );
  }
  else{
    echo json_encode(
        ['message' => 'Blog Not Created']
    );
  }

?> 

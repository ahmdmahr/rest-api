<?php
  // Headers
  // Public API 
  // can be accessed by anybody and we are not get into authorization or tokens  
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');


  include '../../config/Database.php';
  include '../../models/Blog.php';

  // Init DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Init blog object
  $blog = new Blog($db);

  // Blog query 
  $result = $blog->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any blog
  if($num > 0){
    // Blog array
    $blogs = [];
    $blogs['data'] = $result->fetchAll(PDO::FETCH_ASSOC);

    // execute html stuff of the body like <br> <h1> <p>
    // $blogs['data']['body'] = html_entity_decode($blogs['data']['body']);

    // Turn to JSON & Output
    echo json_encode($blogs);
  }
  else{
    // No Blogs
    echo json_encode(array('message' => 'No Blogs Found'));
  }

?>

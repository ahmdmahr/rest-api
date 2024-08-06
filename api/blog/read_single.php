<?php
  // Headers
  
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');


  include '../../config/Database.php';
  include '../../models/Blog.php';

  // Init DB & Connect
  $database = new Database();
  $db = $database->connect();

  // Init blog object
  $blog = new Blog($db);

  // GET ID
  //  die() is like return 0; 
  $blog->id = isset($_GET['id'])? $_GET['id'] : die();

  // Blog query 
  $result = $blog->read_single();
  
  $blogs['data'] = $result->fetch(PDO::FETCH_ASSOC);

  // Make JSON
  
  echo json_encode($blogs);

?>

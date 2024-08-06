<?php
 class Blog{
    // DB stuff
    private $conn;
    private $table = 'blogs';

    // Blog properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;

    // Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    // Get Blogs
    public function read(){
        // Create query

        // table_name + another_name = it's alias
        $query = "SELECT c.name AS category_name , b.id , b.category_id , b.title , b.body , b.author
                  FROM $this->table b
                  LEFT JOIN
                  categories c ON b.category_id = c.id
                  ORDER BY 
                  b.created_at DESC";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

     // Get Single Blog
     public function read_single(){
        // Create query

        // table_name + another_name = it's alias
        $query = "SELECT c.name AS category_name , b.id , b.category_id , b.title , b.body , b.author
                  FROM $this->table b
                  LEFT JOIN
                  categories c ON b.category_id = c.id
                  WHERE 
                  b.id = :id";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(':id',$this->id);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // Create Blog
    public function create(){
    //  Create Query

    $query = "INSERT INTO
              $this->table
              SET
              id = :id,
              title = :title,
              body = :body,
              author = :author,
              category_id = :category_id";

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->id = htmlspecialchars($this->id);
    $this->title = htmlspecialchars($this->title);
    $this->body = htmlspecialchars($this->body);
    $this->author = htmlspecialchars($this->author);
    $this->category_id = htmlspecialchars($this->category_id);

    // Bind data
    $stmt->bindParam(':id',$this->id);
    $stmt->bindParam(':title',$this->title);
    $stmt->bindParam(':body',$this->body);
    $stmt->bindParam(':author',$this->author);
    $stmt->bindParam(':category_id',$this->category_id);

    // Execute query
    if($stmt->execute()){
        return true;
    }

    // Print error if something goes wrong

    // %s is a placeholder for $stmt->error!
    printf("Error: %s.\n",$stmt->error);
    return false;


    }  

     // Update Blog
    public function update(){
        //  Create Query
    
        $query = "UPDATE 
                  $this->table
                  SET
                  title = :title,
                  body = :body,
                  author = :author,
                  category_id = :category_id
                  WHERE
                  id = :id";
    
        // Prepare statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->id = htmlspecialchars($this->id);
        $this->title = htmlspecialchars($this->title);
        $this->body = htmlspecialchars($this->body);
        $this->author = htmlspecialchars($this->author);
        $this->category_id = htmlspecialchars($this->category_id);
    
        // Bind data
        $stmt->bindParam(':id',$this->id);
        $stmt->bindParam(':title',$this->title);
        $stmt->bindParam(':body',$this->body);
        $stmt->bindParam(':author',$this->author);
        $stmt->bindParam(':category_id',$this->category_id);
    
        // Execute query
        if($stmt->execute()){
            return true;
        }
    
        // Print error if something goes wrong
    
        // %s is a placeholder for $stmt->error!
        printf("Error: %s.\n",$stmt->error);
        return false;
    
    
    }
    
    // Delete Blog
    public function delete(){
        // Create query
        $query = "DELETE FROM 
                  $this->table
                  WHERE 
                  id = :id";
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->id = htmlspecialchars($this->id);

        // Bind data
        $stmt->bindParam(':id',$this->id);

        // Execute query
        if($stmt->execute()){
            return true;
        }
    
        // Print error if something goes wrong
    
        // %s is a placeholder for $stmt->error!
        printf("Error: %s.\n",$stmt->error);
        return false;
    }

 }

   
?>
<?php 

class Post {
    private $db;

    public function __construct()
    {
       $this->db = new Database; 
    }
    // get all posts
    public function getPosts(){
        $sql = "SELECT * ,
                posts.id AS postId ,
                users.id AS userId ,
                posts.create_at AS postCreated
                FROM posts 
                INNER JOIN users 
                ON posts.user_id = users.id
                ORDER BY posts.create_at DESC ";
        $this->db->query($sql);

        return $results = $this->db->resultsSet();
    }

    // get single post entry  by its id 
    public function getPostById( $id ){
        $sql = "SELECT * FROM posts WHERE id = :id ";
        $this->db->query( $sql );
        $this->db->bind(":id" , $id );

        $row = $this->db->single();
        return $row;
    } 

    // add new post 
    public function addPost($post){
        $sql = "INSERT INTO posts ( user_id , title , body )
                 VALUES ( :user_id , :title , :body )";
        $this->db->query($sql);

        $this->db->bind(":user_id" , $_SESSION["user_id"]);
        $this->db->bind(":title" , $post["title"]);
        $this->db->bind(":body" , $post["body"]);

        if( $this->db->execute() ) 
            return true;
        else
            return false;
    }

    // Edit post 
    public function editPost($data){
        $sql = "UPDATE posts SET title = :title , body = :body WHERE id = :id ";
        $this->db->query( $sql );
        $this->db->bind(":title" , $data["title"] );
        $this->db->bind(":body" , $data["body"] );
        $this->db->bind(":id" , $data["id"] );

        if( $this->db->execute() ) 
            return true;
        else
            return false;
    }
        // delete post 
    public function deletePost($id){
        $this->db->query('DELETE FROM posts WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);
  
        // Execute
        if($this->db->execute()){
          return true;
        } else {
          return false;
        }
      }
}
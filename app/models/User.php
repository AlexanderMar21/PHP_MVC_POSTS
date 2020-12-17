<?php 

class User {
    private $db;
    
    public function __construct()
    {
        $this->db = new Database;
    }
    // Register
    public function register($data){
        $sql = "INSERT INTO users ( name , email , password  ) VALUES ( :name , :email ,:password )";
        $this->db->query($sql);
        $this->db->bind(":name" , $data["name"]);
        $this->db->bind(":email" , $data["email"]);
        $this->db->bind(":password" , $data["password"]);
        // execute 

        if( $this->db->execute() ) 
            return true;
        else
            return false;
    }
    
    // User Login 

    public function login( $email , $password ){
        $sql = "SELECT * FROM users WHERE email = :email ";
        $this->db->query($sql);
        $this->db->bind(":email" , $email ); 

        $row = $this->db->single();

        $hashed_password = $row->password;

        if( password_verify($password , $hashed_password )){
            return $row;
        } else {
            return false;
        }

    }

    // Check user by email
    public function findUserByEmail( $email){
        $sql = "SELECT * FROM users WHERE email = :email ";
        $this->db->query($sql);
        $this->db->bind(":email" , $email );
        $row = $this->db->single();
        
        // check row
        if($this->db->rowCount() > 0 )
            return true;
        else return false;
    }

    // Check user by id
    public function getUserById( $id){
        $sql = "SELECT * FROM users WHERE id = :id ";
        $this->db->query($sql);
        $this->db->bind(":id" , $id );
        return $row = $this->db->single();
        
    }


}
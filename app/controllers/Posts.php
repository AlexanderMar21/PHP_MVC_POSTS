<?php

class Posts extends Controller {
    public function __construct()
    {
        if(!isLoggedIn()){
            redirect("users/login");
        }

        $this->postModel = $this->model("Post");
        $this->userModel = $this->model("User");
    }

    public function index(){
        // get posts
        $posts = $this->postModel->getPosts();

        $data = [
            "posts" => $posts
        ];

        $this->view("posts/index" , $data );
    }

    // add new post entry
    public function add(){
        // if the form is posted 
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // sanitize data
            $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);

            $data = [
                "title" => trim($_POST["title"]),
                "body" => trim($_POST["body"]) ,
                "user_id" => $_SESSION["user_id"] ,
                "title_err" => ""  ,
                "body_err" => "" 
            ];

                    // Validations
            if (empty($data["title"]))
                $data["title_err"] = "Please enter Title";
            if (empty($data["body"]))
                $data["body_err"] = "Body Text Should Not Be Empty";

            if(empty($data["title_err"]) && empty($data["body_err"])){
                // Validate Succeesfully
                if ($this->postModel->addPost($data)){
                    flash("post_message" ,"Post Added ");
                    redirect("posts");
                }
            } else {
                // load view with errors
                $this->view("posts/add" , $data);
            }
            
        }else {
            $data = [
                "title" => "",
                "body" => ""
            ];
            // load the initial form 
            $this->view("posts/add" , $data );

        }
    }
    // show detailed post
    public function show( $id ){
        $post = $this->postModel->getPostById( $id );
        $user = $this->userModel->getUserById( $post->user_id );
        $data = [
                "post" => $post ,
                "user" => $user 
            ];

        $this->view("posts/show" , $data);
    }

                //  ======    Edit  post entry   ====

       public function edit( $id ){
        // if the form is posted 
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // sanitize data
            $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);
        
            $data = [
                "id" => $id ,
                "title" => trim($_POST["title"]),
                "body" => trim($_POST["body"]) ,
                "title_err" => ""  ,
                "body_err" => "" 
            ];

                    // Validations
            if (empty($data["title"]))
                $data["title_err"] = "Please enter Title";
            if (empty($data["body"]))
                $data["body_err"] = "Body Text Should Not Be Empty";

            if(empty($data["title_err"]) && empty($data["body_err"])){
                // Validate Succeesfully
                if ($this->postModel->editPost($data)){
                    flash("post_message" ,"Post Updated ");
                    redirect("posts");
                } else {
                    die("something went wrong");
                }
            } else {
                // load view with errors
                $this->view("posts/edit" , $data);
            }
            
        }else {
            // get existing post from model 
            $post = $this->postModel->getPostById( $id );
            // check for post author 
            if($post->user_id != $_SESSION["user_id"]){
                redirect("posts");
            }

            $data = [
                "id" => $id ,
                "title" => $post->title ,
                "body" => $post->body 
            ];
            // load the initial values before edit
            $this->view("posts/edit" , $data );

        }
    }
            // delete post
    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Get existing post from model
          $post = $this->postModel->getPostById($id);
          
          // Check for author of the post
          if($post->user_id != $_SESSION['user_id']){
            redirect('posts');
          }
  
          if($this->postModel->deletePost($id)){
            flash('post_message', 'Post Removed');
            redirect('posts');
          } else {
            die('Something went wrong');
          }
        } else {
          redirect('posts');
        }
      }
}
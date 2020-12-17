<?php 

class Users extends Controller {
    public function __construct()
    {
        $this->userModel = $this->model("User");
    }
    public function index(){
        echo "Users";
    }

        //  =============   REGISTER USER ===========


    public function register(){

        //Check if user is logged in 
        if( isLoggedIn()){
            redirect("");
        }
        // check for posts
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            // Proccess the form

            // Sanitize Data from Post Request
            $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING );
            // init data
            $data = [
                'name' => trim($_POST["name"]),
                "email" => trim($_POST["email"]),
                "password" => trim($_POST["password"]),
                "confirm_password" =>trim($_POST["confirm_password"]),
                "name_err" => "",
                "email_err" => "",
                "password_err" => "",
                "confirm_password_err" => ""
            ];

            // Validate Email
            if (empty($data['email'])){
                $data["email_err"] = "Please enter email";
            } else{
                // check email if is already in our database
                if($this->userModel->findUserByEmail($data['email'])){
                   $data["email_err"] = "Email is already registered";
                    }
                }

            // Validate Name
            if (empty($data['name']))
                $data["name_err"] = "Please enter name";
            // Password Validation
            if (empty($data['password']))
                $data["password_err"] = "Please enter password"; 
            else if (strlen($data["password"]) < 6)
                $data["password_err"] = "Password must be at least 6 characters";
            // Validate Confirm Password 
            if (empty($data['confirm_password']))
                $data["confirm_password_err"] = "Please confirm password"; 
            else{
                if($data["password"] != $data["confirm_password"])
                    $data["confirm_password_err"] = "Passwords dont match";
            }

            // Make sures errors are empty

            if ( empty($data["name_err"]) && empty($data["email_err"]) && empty($data["password_err"]) 
            && empty($data["confirm_password_err"]) ){
                //Validate Succesfully 

                // Hash Password
                $data["password"] = password_hash( $data["password"] , PASSWORD_DEFAULT );
                // Register User

                if ($this->userModel->register($data)){
                    flash("register_success" , "You are registered and can log in ");
                    redirect("users/login");
                }else {
                    die("something went wrong");
                }

            }else {
                // load View with erros
                $this->view("users/register" , $data);
            }  
            

        } else {
            // init data 
            $data = [
                'name' => '',
                "email" => '',
                "password" => '',
                "confirm_password" => "",
                "name_err" => "",
                "email_err" => "",
                "password_err" => "",
                "confirm_password_err" => ""
            ];
           
            // Load View
            $this->view("users/register" , $data );
        }
    }

        // ==========      LOGIN  USER  ===============


    public function login(){

        // check if user is logged in 
        if (isLoggedIn()){
            redirect("");
        }

        // check for post
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            // Proccess form

            // Sanitize Data from Post Request
            $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING );
            // init data
            $data = [
                "email" => trim($_POST["email"]),
                "password" => trim($_POST["password"]),
                "email_err" => "",
                "password_err" => "",
            ];

                    //  Validations 

            // Validate Email
            if (empty($data['email']))
                $data["email_err"] = "Please enter email";
            
            // Validate Password
            if (empty($data['password']))
            $data["password_err"] = "Please enter password";
            // check if user email exists
            if ($this->userModel->findUserByEmail($data["email"])){
                // user found
            } else {
                // user not found
                $data["email_err"] = "No user found";
            }

            // check all errors are empty
            if( empty($data["password_err"]) && empty($data["email_err"])){
                // login user 
                $loggedInUser = $this->userModel->login($data["email"] , $data["password"]);

                if ($loggedInUser){
                    // create session
                    $this->createUserSession($loggedInUser );
                } else {
                    $data["password_err"] = "Password Incorect";
                    $this->view("users/login" , $data );
                }
            }else {
                // reload the view for login with the previous data given
                $this->view("/users/login" , $data);
            }


        }else {
            // init data 
            $data = [
                "email" => '',
                "password" => '',
                "name_err" => "",
                "password_err" => ""
            ];
            // Load View
            $this->view("users/login");
        }

        
    }
    // Create Session for user login 
    public function createUserSession($user){
        $_SESSION["user_id"] = $user->id;
        $_SESSION["user_name"] = $user->name;
        $_SESSION["user_email"] = $user->email;
        redirect("posts");
    }

    // logout 
    public function logout(){
       unset($_SESSION["user_id"]); 
       unset($_SESSION["user_name"]); 
       unset($_SESSION["user_email"]);
       session_destroy();
       redirect("users/login"); 
    }
    
}
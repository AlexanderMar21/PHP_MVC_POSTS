<?php 
// Loads Models And views
class Controller {

    // load model
    public function model( $model ){
        // require model file 
        require_once MODELS . $model . ".php";

        // Instantiate Model
        return new $model();

    }

    // view method 

    public function view( $view  , $data = [] ){
        // Check for view file
        if ( file_exists(VIEWS .$view . ".php" )){
            require_once VIEWS .$view . ".php";
        } else {
            // view doesnt exists 
            die("File doest exists");
        }
    }

}
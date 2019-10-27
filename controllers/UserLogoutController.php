<?php
    namespace controllers;
    use infra;
    use infra\repositories;
    use PDO;

    class UserLogoutController implements IBaseController
    {
        
        public function __construct($factory)
        {
           
        }

        
        public function proccessRequest() : void
        {
            if (isset($_SESSION["userId"])) {
                session_destroy();
                header("location: /");
                exit;
            } 
        }
    }
?>
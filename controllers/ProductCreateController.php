<?php
    namespace controllers;
    
    use controllers;
    use infra;
    use models;
    use infra\repositories;

    class ProductCreateController implements IBaseController
    {
        public function __construct($factory)
        {
            
        }
        
        public function proccessRequest() : void
        {
            require $_SERVER['DOCUMENT_ROOT'] . '\\views\\admin\\product\\cadastro-produto.php';
        }
    }
?>
<?php
    namespace services;
    use models\User;
    use models\responses\RegisterSellerResponse;

    class SellerService 
    {
        private $_repoUser;
        private $_repoSeller;

        public function __construct($factory)
        {
            $this->_repoUser = $factory->getUserRepository();
            $this->_repoSeller = $factory->getSellerRepository();
        }

        public function register($request)
        {
            if ($this->_repoUser->getByLogin($request->getLogin()) != null)
            {
                //ja existe o usuario...
                return new RegisterSellerResponse(false, "O Login informado está indisponível.");
            } 
            else {
                try{
                    //criando usuário do tipo vendedor...
                    $user = new User(
                        null,
                        $request->getLogin(),
                        trim($request->getPassword()),
                        $request->getName(),
                        'vendedor'
                    );
                    $userId = $this->_repoUser->add($user);

                    //adicionando dados de vendedor...
                    $this->_repoSeller->addSimplifiedSeller(
                        $userId,
                        $request->getLastName()
                    );

                    //efetuando login
                    $_SESSION["userId"] = $userId; 
                    $_SESSION["userName"] = stripslashes($request->getName());                     
                    $_SESSION["role"] = stripslashes($user->getRole());    

                    return new RegisterSellerResponse(true, "Você foi registrado com sucesso.");
                }catch(Exception $e){
                    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
                    //exit();
                }
            }
        }

        public function getAllPaginated()
        {
            $page = 1;
            if (isset($_GET["p"]))
                $page = intval($_GET["p"]);
            
            $paginatedResults = $this->_repoSeller->getAll($page, null, 5);
            
            return $paginatedResults;
        }
    }
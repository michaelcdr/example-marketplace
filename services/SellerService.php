<?php
    namespace services;
    use models\User;
    use models\responses\RegisterSellerResponse;
    use models\SellerCreateViewModel;
    use models\Address;
    use models\JsonError;
    use models\JsonSuccess;
    use infra\Logger;
    use models\SellerEditViewModel;

    class SellerService 
    {
        private $_repoUser;
        private $_repoSeller;
        private $_repoState;
        private $_repoAddress;

        public function __construct($factory)
        {
            $this->_repoUser = $factory->getUserRepository();
            $this->_repoSeller = $factory->getSellerRepository();
            $this->_repoState = $factory->getStateRepository();
            $this->_repoAddress = $factory->getAddressRepository();
        }

        public function register($request)
        {
            if ($this->_repoUser->getByLogin($request->getLogin()) != null)
            {
                //ja existe o usuario...
                return new RegisterSellerResponse(false, "O Login informado está indisponível.");
            } 
            else 
            {
                try
                {
                    //criando usuário do tipo vendedor...
                    $user = new User(
                        null,
                        $request->getLogin(),
                        trim($request->getPassword()),
                        $request->getName(),
                        'vendedor',
                        "",
                        ""
                    );
                    $userId = $this->_repoUser->add($user);
                    echo($userId);
                    //adicionando dados de vendedor...
                    $this->_repoSeller->addSimplifiedSeller($userId);
                    //efetuando login
                    $_SESSION["userId"] = $userId; 
                    $_SESSION["userName"] = stripslashes($request->getName());                     
                    $_SESSION["role"] = stripslashes($user->getRole());    

                    return new RegisterSellerResponse(true, "Você foi registrado com sucesso.");
                }
                catch(Exception $e)
                {
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

            $search = null;
            if (isset($_POST["s"]))
                $search = $_POST["s"];

            $paginatedResults = $this->_repoSeller->getAll($page, $search, 5);
            
            return $paginatedResults;
        }

        public function add($seller, $user,$address)
        {
            //sendo pessimista e prevendo que vai dar merda...
            $retorno = new JsonError("Não foi possivel cadastrar o vendedor."); 

            //validando modelo se valido retornamos um JSON.
            if ($seller->isValid() && $user->isValid())
            {
                //cadastrando usuario...
                //var_dump($user);
                if ($this->_repoUser->getByLogin($user->getLogin()) != null)
                    return new JsonError("Login indisponível.");

                $userId = $this->_repoUser->add($user);
                //echo "<br> adiciono usuario id : " . $userId . " <br>";
                if (!is_null($userId))
                {
                    //cadastrando endereço...
                    $address->setUserId($userId);
                    $addressId = $this->_repoAddress->add($address);
                    $seller->setUserId($userId);
                    $this->_repoSeller->add($seller);
                    
                    $retorno = new JsonSuccess("Vendedor cadastrado com sucesso.");
                }
            } 
            return $retorno;
        }

        public function getCreateViewModel()
        {
            return new SellerCreateViewModel(
                $this->_repoState->getAll()
            );
        }

        public function getEditViewModel(){
            $sellerId = intval($_GET["id"]);
            $seller = $this->_repoSeller->getById($sellerId);
            $address = $this->_repoAddress->getFirstByUserId($seller->getUserId());
            return new SellerEditViewModel(
                $seller,
                $this->_repoState->getAll(),
                $address
            );
        }

        public function update(){
            $sellerId = intval($_GET["id"]);
            $seller = $this->_repoSeller->getById($sellerId);
            
            if (is_null($seller)){
                Logger::write("Não encontrou vendedor ao tentar editar");
            } else {
                $seller->setWebsite($_POST["website"]);
                $seller->setEmail($_POST["email"]);
                if (!isset($_POST["cnpj"]) || is_null($_POST["cnpj"])){
                    //pessoa fisica
                    $seller->setCpf($_POST["cpf"]);
                    $seller->setAge($_POST["age"]);
                    $seller->setDateOfBirth($_POST["dataNascimento"]);
                } else {
                    //pessoa juridica
                    $seller->setCompany($_POST["company"]);
                    $seller->setCnpj($_POST["cnpj"]);
                    $seller->setFantasy($_POST["fantasyName"]);
                    $seller->setBranchOfActivity($_POST["branchOfActivity"]);
                }
                $this->_repoSeller->update($seller);
            }
        }
    }
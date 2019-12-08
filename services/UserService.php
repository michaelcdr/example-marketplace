<?php
    namespace services;
    use models\User;
    use models\responses\RegisterUserResponse;
    use models\JsonSuccess;
    use models\JsonError;
    use models\UserEdit;
    use models\Address;
    class UserService 
    {
        private $_repoUser;
        private $_repoAddresses;
        public function __construct($factory)
        {
            $this->_repoUser = $factory->getUserRepository();
            $this->_repoAddresses = $factory->getAddressRepository();
        }

        public function register($request)
        {
            if ($this->_repoUser->getByLogin($request->getLogin()) != null) //ja existe o usuario
                return new RegisterUserResponse(false, "O Login informado está indisponível.");
            else 
            {
                try
                {
                    //criando usuário do tipo comum...
                    $user = new User(
                        null,
                        $request->getLogin(),
                        trim($request->getPassword()),
                        $request->getName(),
                        'comum',
                        ''
                    );
                    $userId = $this->_repoUser->add($user);

                    //efetuando login
                    $_SESSION["userId"] = $userId; 
                    $_SESSION["userName"] = stripslashes($request->getName());                     
                    $_SESSION["role"] = stripslashes($user->getRole());    
                    return new RegisterUserResponse(true, "Você foi registrado com sucesso.");

                } catch(Exception $e){
                    return new RegisterUserResponse(
                        false, "Não foi possivel registrar o usuário.");
                }
            }
        }

        public function update()
        {
            $user = new UserEdit($_POST["userId"],$_POST["name"], $_POST["login"], $_POST["role"],$_POST["cpf"]);
            $retorno =  null;

            if ($user->isValid())
            {
                $this->_repoUser->altera($user); 
                
                //removendo endereços antigos
                $this->_repoAddresses->removeAllByUserId($user->getUserId());
                
                //adicionando endereços novos...
                if (isset($_POST["addresses"]))
                {
                    foreach($_POST["addresses"] as $address)
                    {
                        $addressObj = new Address(
                            null,
                            $_POST["userId"], 
                            $address["street"],
                            $address["cep"],
                            $address["neighborhood"],
                            $address["city"],
                            $address["stateId"],
                            $address["complement"]
                        );
                        $this->_repoAddresses->add($addressObj);
                    }
                }

                $retorno = new JsonSuccess("Usuário alterado com sucesso");
                header('Content-type:application/json;charset=utf-8');
            } 
            else 
                $retorno = new JsonError("Não foi possivel cadastrar o usuário");  

            return $retorno;

        }
    }
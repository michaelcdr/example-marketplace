<?php
    namespace services;
    use models\User;
    use models\responses\RegisterUserResponse;

    class UserService 
    {
        private $_repoUser;

        public function __construct($factory)
        {
            $this->_repoUser = $factory->getUserRepository();
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
                        'comum'
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
    }
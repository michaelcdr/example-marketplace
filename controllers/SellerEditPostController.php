<?php
    namespace controllers;
    use controllers\IBaseController;
    use models\Seller;
    use models\User;
    use models\Address;
    use services\SellerService;

    class SellerEditPostController implements IBaseController
    {
        private $_sellerService;

        public function __construct($factory)
        {
            $this->_sellerService = new SellerService($factory);
        }
        
        public function proccessRequest() : void
        {
            $retorno = null;

            //obtendo dados da requisição e preparando a model
            $seller = new Seller(
                intval($_POST["id"]),
                $_POST["name"],
                $_POST["lastName"],
                $_POST["company"],
                $_POST["fantasyName"],                
                null,
                null
            );
            
            $seller->setEmail($_POST["email"]);
            $seller->setWebsite($_POST["website"]);
            if ($_POST["type"] == "juridica"){
                $seller->setCompany($_POST["company"]);
                $seller->setCnpj($_POST["cnpj"]);
                $seller->setBranchOfActivity($_POST["branchOfActivity"]);
            } else{
                $seller->setAge($_POST["age"]);
                $seller->setDateOfBirth($_POST["dateOfBirth"]);
            }
            var_dump($seller);
            

            //montando model de endereço...
            // $address = new Address(
            //     null,
            //     null,
            //     $_POST["street"],
            //     $_POST["cep"],
            //     $_POST["neighborhood"],
            //     $_POST["city"],
            //     $_POST["stateId"],
            //     $_POST["complement"]
            // );
            // $retorno = $this->_sellerService->add($seller, $user, $address);
            header('Content-type:application/json;charset=utf-8');
            echo json_encode($retorno);
        }
    }
?>
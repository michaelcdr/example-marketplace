<?php
    namespace controllers;
    use models\JsonSuccess;
    use models\JsonError;

    class CartAtualizarQtdProdutoController implements IBaseController
    {
        private $_cartService;
        
        public function __construct($factory)
        {
            $this->_cartService = new CartService($factory);
        }
        
        public function proccessRequest() : void
        {
            $productId = $_POST["productId"];
            $qtd = $_POST["qtd"];
            $retorno = null;
            try
            {
                $response = $this->_cartService->updateQtdProduct($productId, $qtd);
                if ($response->success){
                    $retorno = new JsonSuccess("Quantidade atualizada com sucesso.");
                } else {
                    $retorno = new JsonError($response->getError());
                }
            }  
            catch (Exception $e) 
            {
                $retorno = new JsonError("Não foi possivel atualizar a quantidade.");   
            }
            header('Content-type:application/json;charset=utf-8');
            echo json_encode($retorno);
        }
    }
?>
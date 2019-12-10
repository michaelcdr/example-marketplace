<?php
    namespace controllers;
    use services\SellerService;

    class SellerEditController implements IBaseController
    {
        private $_sellerService;

        public function __construct($factory)
        {
            $this->_sellerService = new SellerService($factory);
        }
        
        public function proccessRequest() : void
        {
            $model = $this->_sellerService->getEditViewModel();
            require "views/admin/sellers/editar.php";
        }
    }
?>
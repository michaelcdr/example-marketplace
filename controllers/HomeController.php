<?php
    namespace controllers;
    use infra;
    use infra\repositories;
    use PDO;
    class HomeController implements IBaseController
    {
        private $_repoOfertas;
        private $_repoCarousel;

        public function __construct($factory)
        {
            // echo "controller home";
            // echo '<pre>';
            // var_dump($factory);
            // echo '</pre>';
            $this->_repoOfertas = $factory->getProductOnOfferRepository();
            $this->_repoCarousel = $factory->getCarouselRepository();
        }

        public function getProductsOnOffer()
        {
            return $this->_repoOfertas->getAll();
        }

        public function getCaroselItens()
        {
            return $this->_repoCarousel->getAll();
        }
        
        public function proccessRequest() : void
        {
            //echo "request index";
            $ofertas = $this->getProductsOnOffer();
            $caroselItens = $this->getCaroselItens();
            require "home.php";
        }
    }
?>
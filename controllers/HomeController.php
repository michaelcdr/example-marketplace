<?php
    namespace controllers;
    use infra;
    use infra\repositories;

    class HomeController implements IBaseController
    {
        private $_repoOfertas;
        private $_repoCarousel;

        public function __construct($factory)
        {
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
            $ofertas = $this->getProductsOnOffer();
            $caroselItens = $this->getCaroselItens();
            require "home.php";
        }
    }
?>
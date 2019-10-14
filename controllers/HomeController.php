<?php
    
    require_once './infra/repositories-mysql/ProductOnOfferRepository.php';
    require_once './infra/repositories-mysql/CarouselRepository.php';
    require_once './infra/MySqlRepositoryFactory.php';

    class HomeController
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
    }
?>
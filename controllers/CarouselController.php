<?php
    require_once './infra/repositories-mysql/CarouselRepository.php';
    require_once './infra/MySqlRepositoryFactory.php';

    class CarouselController
    {
        private $_repoCarousel;

        public function __construct($factory)
        {
            $this->_repoCarousel = $factory->getCarouselRepository();
        }

        public function getCaroselItens()
        {
            return $this->_repoCarousel->getAll();
        }
    }
?>
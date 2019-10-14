<?php

    require_once './infra/interfaces/ICarouselRepository.php';
    require_once './infra/MySqlRepository.php';

    class CarouselRepository extends MySqlRepository implements ICarouselRepository
    {
        public function getAll()
        {
            $query = "select CarouselImageId, FileName, `Order` from CarouselImages order by `order`";
            $resultado = $this->conn->query($query);
            $lista = $resultado->fetchAll();
            return $lista;
        }
    }

?>
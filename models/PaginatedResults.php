<?php
    namespace models;
    
    class PaginatedResults 
    {
        public $results;
        public $qtdTotal;
        public $qtdTotalFiltered;
        public $hasPreviousPage;
        public $hasNextPage;
        public $page;
        public $numberOfPages;

        public function __construct(
            $results,$qtdTotal,$qtdTotalFiltered,$hasPreviousPage,$hasNextPage,$page,$numberOfPages)
        {
            $this->results = $results;
            $this->qtdTotal = $qtdTotal;
            $this->qtdTotalFiltered = $qtdTotalFiltered;
            $this->hasPreviousPage= $hasPreviousPage;
            $this->hasNextPage = $hasNextPage;
            $this->page = $page;
            $this->numberOfPages = $numberOfPages;
        }
    }
?>
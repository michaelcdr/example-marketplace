<?php
    namespace controllers;
    use infra;
    use infra\repositories;

    class SeedController implements IBaseController
    {
        private $_repoSeed;

        public function __construct($factory)
        {
            $this->_repoSeed = $factory->getSeedRepository();
        }

        public function proccessRequest() : void
        {
            
            $this->_repoSeed->seed();
        }

        public function proccessDestroyRequest() : void
        {
            $this->_repoSeed->destroyDatabase();
        }

        public function proccessCreateDbRequest() : void
        {
            $this->_repoSeed->createDb();
        }
        
    }
?>
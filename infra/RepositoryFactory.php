<?php

    abstract class RepositoryFactory {

        protected abstract function getConnection();

        public abstract function getUserRepository();
        public abstract function getProductOnOfferRepository();
        public abstract function getProductRepository();
    }
?>
<?php
    namespace infra\repositories;
    use infra\MySqlRepository;
    use infra\interfaces;
    use infra\interfaces\ISeedRepository;

    class SeedRepository implements ISeedRepository
    {
        private $conn;

        public function __construct($connection)
        {
            $this->conn =  $connection;
        }

        public function seed()
        {
            //inserindo produtos...
            $this->conn->exec(
                "insert into products(title,description,price,createdat,createdby,offer,stock,sku)values(
                    'GUITARRA FENDER STANDARD TELECASTER MEXICANA BLACK - 014-5102-506',
                    'A Fender traz a Standard Telecaster para guitarristas que apreciam estilo e versatilidade por um super valor!',
                    5690,now(),'michael',1,10,'001');"
            );
            $this->conn->exec(
                "insert into products(title,description,price,createdat,createdby,offer,stock,sku)values(
                    'GUITARRA FENDER AMERICAN SPECIAL STRATOCASTER MAPLE 2-COLOR SUNBURST (2012) - ACOMPANHA HARD CASE',
                    'A lendária guitarra Stratocaster em sua versão mais tradicional!',
                    7990,now(),'michael',1,10,'002');"
            );
            $this->conn->exec(
                "insert into products(title,description,price,createdat,createdby,offer,stock,sku)values(
                    'GUITARRA JACKSON DINKY JS11 GLOSS BLACK - 291 0110 503',
                    'Uma guitarra de alta qualidade e excelente preço da lendária marca Jackson!',
                    1790,now(),'michael',1,10,'003');"
            );
            
            //inserindo imagens de produtos...
            $this->conn->exec(
                "insert into productsimages(productid,filename)
                values 
                (
                    (
                        select ProductId from products where 
                        title like '%GUITARRA FENDER STANDARD TELECASTER MEXICANA BLACK - 014-5102-506%' 
                        limit 1
                    ) 
                , 'fender-mex-black-014-5102-506.jpg');"
            );
            $this->conn->exec(
                "insert into productsimages(productid,filename)
                values 
                (
                    (
                        select ProductId from products where 
                        title like '%GUITARRA FENDER AMERICAN SPECIAL STRATOCASTER MAPLE 2-COLOR SUNBURST (2012) - ACOMPANHA HARD CASE%' 
                        limit 1
                    ) 
                , 'fender-american-especial-stratocaster-maple2-color-sunburst2012.jpg');"
            );
            $this->conn->exec(
                "insert into productsimages(productid,filename)
                values 
                (
                    (
                        select ProductId from products where 
                        title like '%GUITARRA JACKSON DINKY JS11 GLOSS BLACK - 291 0110 503%' 
                        limit 1
                    ) 
                , 'jackson-dincky-JS11GLOSSBLACK2910110503.jpg');"
            );

           

            // carrossel
            $this->conn->exec("insert into carouselimages(filename,`order`) values ('guitar-1920x384-1.jpg',1)");
            $this->conn->exec("insert into carouselimages(filename,`order`) values ('guitar-1920x384-2.jpg',2)");
            $this->conn->exec("insert into carouselimages(filename,`order`) values ('guitar-1920x384-3.jpg',3)");
            header('Location: /');
        }

        public function createDb()
        {
            $this->createTableUsers();  
            $this->createTableProducts();
            $this->createTableProductImages();
            $this->createTableCategories();
            $this->createTableCarouselImages();
            $this->createTableCart();
        }

        function destroyDatabase()
        {   
            
            
            $query = "drop table ProductsImages";
            $this->conn->exec($query);
            
            $query = "drop table Products";
            $this->conn->exec($query);
            
            $query = "drop table CarouselImages";
            $this->conn->exec($query);
            
            $query = "drop table Categories";
            $this->conn->exec($query);
            
            $query = "drop table Users";
            $this->conn->exec($query);

            $this->conn->exec("drop table Carts");
        }

        function createTableUsers()
        {
            $query =  "create table Users(
                UserId  int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                Login varchar(100) not null unique,
                Password varchar(255) not null,
                Name varchar(255) not null
            );";
            $this->conn->exec($query);
        }

        function createTableProducts()
        {
            $query = "CREATE TABLE Products (
                ProductId int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                Title varchar(255) NOT NULL,
                Description varchar(255),
                Price decimal(10,2),
                CreatedAt datetime,
                CreatedBy varchar(255),
                Offer bit(1) not null,
                Stock int(11) not null,
                Sku varchar(45) not null
            );";
            $this->conn->exec($query);
        }


        function createTableProductImages()
        {
            $query = "CREATE TABLE ProductsImages (
                ProductImageId int PRIMARY KEY AUTO_INCREMENT, 
                ProductId int NOT NULL,
                FileName nvarchar(255) not null, 
                FOREIGN KEY(ProductId) REFERENCES Products(ProductId)
            );";
            $this->conn->exec($query);
        }

        function createTableCategories()
        {
            $query = "CREATE TABLE Categories (
                CategoryId int NOT NULL AUTO_INCREMENT,
                Title varchar(255) NOT NULL,    
                PRIMARY KEY (CategoryId)
            );";            
            $this->conn->exec($query);
        }

        function createTableCarouselImages()
        {      
            $query = "CREATE TABLE CarouselImages (
                CarouselImageId int NOT NULL AUTO_INCREMENT,
                FileName varchar(255) NOT NULL,    
                `Order` int not null,
                PRIMARY KEY (CarouselImageId)
            );";
            $this->conn->exec($query);
        }

        function createTableCart()
        {
            $this->conn->exec(
                "CREATE TABLE Carts (
                    CartId int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    CartGroup nvarchar(255) not null,
                    ProductId int not null,    
                    Qtd int not null,
                    CreatedAt datetime not null,
                    FOREIGN KEY(ProductId) REFERENCES Products(ProductId)
                );"
            );
        }
    }

?>
<?php
    namespace infra\repositories;

    use Exception;
    use infra\MySqlRepository;
    use infra\interfaces;
    use infra\interfaces\ISeedRepository;

    class SeedRepository 
        extends MySqlRepository 
        implements ISeedRepository
    {
        public function seed()
        {
            $this->createTableOrder();
            $this->createTableOrderItens();

            // $this->destroyDatabase();
            // $this->createDb();

            //inserindo produtos...
            // $this->conn->exec(
            //     "insert into products(
            //         title,
            //         description,
            //         price,c
            //         reatedat,
            //         createdby,
            //         offer,
            //         stock,
            //         sku
            //     ) values (
            //         'GUITARRA FENDER STANDARD TELECASTER MEXICANA BLACK - 014-5102-506',
            //         'A Fender traz a Standard Telecaster para guitarristas que apreciam 
            //         estilo e versatilidade por um super valor!',
            //         5690,now(),'michael',1,10,'001'
            //     );"
            // );
            // $this->conn->exec(
            //     "insert into products(
            //         title,
            //         description,
            //         price,c
            //         reatedat,
            //         createdby,
            //         offer,
            //         stock,
            //         sku
            //     ) values(
            //         'GUITARRA FENDER AMERICAN SPECIAL STRATOCASTER MAPLE 2-COLOR SUNBURST 
            //         (2012) - ACOMPANHA HARD CASE',
            //         'A lendária guitarra Stratocaster em sua versão mais tradicional!',
            //         7990,now(),'michael',1,10,'002'
            //     );"
            // );
            // $this->conn->exec(
            //     "insert into products(title,description,price,createdat,createdby,offer,stock,sku)values(
            //         'GUITARRA JACKSON DINKY JS11 GLOSS BLACK - 291 0110 503',
            //         'Uma guitarra de alta qualidade e excelente preço da lendária marca Jackson!',
            //         1790,now(),'michael',1,10,'003');"
            // );
            
            // //inserindo imagens de produtos...
            // $this->conn->exec(
            //     "insert into productsimages(
            //         productid,
            //         filename
            //     )
            //     values 
            //     (
            //         (
            //             select ProductId from products where 
            //             title like '%GUITARRA FENDER STANDARD TELECASTER MEXICANA BLACK - 014-5102-506%' 
            //             limit 1
            //         ) 
            //     , 'fender-mex-black-014-5102-506.jpg');"
            // );
            // $this->conn->exec(
            //     "insert into productsimages(productid,filename)
            //     values 
            //     (
            //         (
            //             select ProductId from products where 
            //             title like '%GUITARRA FENDER AMERICAN SPECIAL STRATOCASTER MAPLE 2-COLOR SUNBURST (2012) - ACOMPANHA HARD CASE%' 
            //             limit 1
            //         ) 
            //     , 'fender-american-especial-stratocaster-maple2-color-sunburst2012.jpg');"
            // );
            // $this->conn->exec(
            //     "insert into productsimages(productid,filename)
            //     values 
            //     (
            //         (
            //             select ProductId from products where 
            //             title like '%GUITARRA JACKSON DINKY JS11 GLOSS BLACK - 291 0110 503%' 
            //             limit 1
            //         ) 
            //     , 'jackson-dincky-JS11GLOSSBLACK2910110503.jpg');"
            // );

            // carrossel
            // $this->conn->exec("insert into carouselimages(filename,`order`) values ('guitar-1920x384-1.jpg',1)");
            // $this->conn->exec("insert into carouselimages(filename,`order`) values ('guitar-1920x384-2.jpg',2)");
            // $this->conn->exec("insert into carouselimages(filename,`order`) values ('guitar-1920x384-3.jpg',3)");
            
            header('Location: /');
        }

        public function createDb()
        {
            $this->createTableStates();
            $this->createTableUsers();  
            $this->createTableSellers();
            $this->createTableProducts();
            $this->createTableProductImages();
            $this->createTableCategories();
            $this->createTableCarouselImages();
            $this->createTableCart();
        }

        public function destroyDatabase()
        {   
            try{
                $this->conn->exec("drop table if exists Sellers");
                $this->conn->exec("drop table if exists States");
                $this->conn->exec("drop table if exists ProductsImages");
                $this->conn->exec("drop table if exists Carts");
                $this->conn->exec("drop table if exists Products");
                $this->conn->exec("drop table if exists CarouselImages");
                $this->conn->exec("drop table if exists Categories");
                $this->conn->exec("drop table if exists Users");
            }
            catch(Exception $ex)
            {
                echo "Ocorreu um erro ao tentar destruir o banco de dados.";
                var_dump($ex);
            }
        }

        public function createTableUsers()
        {
            $query =  "create table Users(
                UserId  int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                Login varchar(100) not null unique,
                Password varchar(255) not null,
                Name varchar(255) not null,
                Role varchar(45) not null
            );";
            $this->conn->exec($query);
        }

        public function createTableProducts()
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


        public function createTableProductImages()
        {
            $query = "CREATE TABLE ProductsImages (
                ProductImageId int PRIMARY KEY AUTO_INCREMENT, 
                ProductId int NOT NULL,
                FileName nvarchar(255) not null, 
                FOREIGN KEY(ProductId) REFERENCES Products(ProductId)
            );";
            $this->conn->exec($query);
        }

        public function createTableCategories()
        {
            $query = "CREATE TABLE Categories (
                CategoryId int NOT NULL AUTO_INCREMENT,
                Title varchar(255) NOT NULL,    
                PRIMARY KEY (CategoryId)
            );";            
            $this->conn->exec($query);
        }

        public function createTableCarouselImages()
        {      
            $query = "CREATE TABLE CarouselImages (
                CarouselImageId int NOT NULL AUTO_INCREMENT,
                FileName varchar(255) NOT NULL,    
                `Order` int not null,
                PRIMARY KEY (CarouselImageId)
            );";
            $this->conn->exec($query);
        }

        public function createTableCart()
        {
            $this->conn->exec(
                "CREATE TABLE Carts (
                    CartId INT NOT NULL  PRIMARY KEY AUTO_INCREMENT,
                    CartGroup varchar(255) NOT NULL,
                    ProductId int not null,    
                    Qtd int not null,
                    CreatedAt datetime not null,
                    FOREIGN KEY(ProductId) REFERENCES Products(ProductId)
                );"
            );
        }
        
        public function createTableStates()
        {
            $this->conn->exec(
                "CREATE TABLE States (
                    StateId INT NOT NULL  PRIMARY KEY AUTO_INCREMENT,
                    Name varchar(255) NOT NULL,
                    StateAbreviattion varchar(255)
                );"
            );
        }

        public function createTableSellers()
        {
            $this->conn->exec(
                "CREATE TABLE Sellers (
                    SellerId int NOT NULL AUTO_INCREMENT,
                    PRIMARY KEY(SellerId),
                    LastName varchar(255),
                    Age int,    
                    CPF int,
                    CEP int,
                    Neighborhood nvarchar(100),
                    Email varchar(100),
                    DateOfBirth datetime,
                    WebSite varchar(255),
                    City varchar(255),
                    
                    Company varchar(150),
                    CNPJ varchar(150),
                    BranchOfActivity varchar(150),
                    FantasyName varchar(150),
                    UserId int,
                    FOREIGN KEY(UserId) REFERENCES Users(UserId),
                    StateId int,
                    FOREIGN KEY(StateId) REFERENCES States(StateId)
                );"
            );
        }

        public function createTableOrder()
        {
            $this->conn->exec(
                "CREATE TABLE Orders (
                    OrderId int NOT NULL AUTO_INCREMENT, PRIMARY KEY(OrderId),
                    Total int, 
                    CreatedAt datetime, 
                    UserId int,
                    FOREIGN KEY(UserId) REFERENCES Users(UserId),
                    StateId int,
                    FOREIGN KEY(StateId) REFERENCES States(StateId),
                    CardOwnerName varchar(150),
                    ExpirationMonth int,
                    ExpirationYear int,
                    Name varchar(150),
                    Address varchar(150),
                    Neighborhood varchar(150),
                    Cep int,                    
                    City varchar(150),
                    CPF int
                );"
            );
        }

        public function createTableOrderItens()
        {
            $this->conn->exec(
                "CREATE TABLE OrderItens (
                    OrderItemId int NOT NULL AUTO_INCREMENT, 
                    PRIMARY KEY(OrderItemId),
                    OrderId int not null,
                    FOREIGN KEY(OrderId) REFERENCES Orders(OrderId),
                    ProductId int,
                    FOREIGN KEY(ProductId) REFERENCES Products(ProductId),
                    Qtd int
                );"
            );
        }
    }
?>
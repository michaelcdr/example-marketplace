<?php
    namespace infra\repositories;

    use Exception;

    use infra;
    use infra\MySqlRepository;
    use infra\interfaces\ISeedRepository;

    class SeedRepository 
        extends MySqlRepository 
        implements ISeedRepository
    {

        private $_repoUser;

        public function __construct($factory)
        {
            var_dump($factory);
            $this->_repoUser = $factory->getUserRepository();
            echo "dsafds";
        }

        public function seedProducts()
        {
             //inserindo produtos...
            $this->conn->exec(
                "insert into products(
                    title,
                    description,
                    price,
                    createdat,
                    createdby,
                    offer,
                    stock,
                    sku
                ) values (
                    'GUITARRA FENDER STANDARD TELECASTER MEXICANA BLACK - 014-5102-506',
                    'A Fender traz a Standard Telecaster para guitarristas que apreciam 
                    estilo e versatilidade por um super valor!',
                    5690,now(),'michael',1,10,'001'
                );"
            );
            $this->conn->exec(
                "insert into products(
                    title,
                    description,
                    price,c
                    reatedat,
                    createdby,
                    offer,
                    stock,
                    sku
                ) values(
                    'GUITARRA FENDER AMERICAN SPECIAL STRATOCASTER MAPLE 2-COLOR SUNBURST 
                    (2012) - ACOMPANHA HARD CASE',
                    'A lendária guitarra Stratocaster em sua versão mais tradicional!',
                    7990,now(),'michael',1,10,'002'
                );"
            );
            $this->conn->exec(
                "insert into products(title,description,price,createdat,createdby,offer,stock,sku)values(
                    'GUITARRA JACKSON DINKY JS11 GLOSS BLACK - 291 0110 503',
                    'Uma guitarra de alta qualidade e excelente preço da lendária marca Jackson!',
                    1790,now(),'michael',1,10,'003');"
            );
            
            //inserindo imagens de produtos...
            $this->conn->exec(
                "insert into productsimages(
                    productid,
                    filename
                )
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
        }

        public function seedUsersAndSellers()
        {
            $userAdmin = new User(null,"michael","123456","michael","admin");
            $userVendedor = new User(null,"michael.vendedor","123456","michael Vendedor","vendedor"); 
            $this->_repoUser->add($userAdmin);
            $this->_repoUser->add($userVendedor);
        }

        public function seedCarousel()
        {
            // carrossel
            $this->conn->exec("insert into carouselimages(filename,`order`) values ('guitar-1920x384-1.jpg',1)");
            $this->conn->exec("insert into carouselimages(filename,`order`) values ('guitar-1920x384-2.jpg',2)");
            $this->conn->exec("insert into carouselimages(filename,`order`) values ('guitar-1920x384-3.jpg',3)");
        }

        public function seed()
        {
            $this->destroyDatabase();
            $this->createDb();

            $this->seedCarousel();
            $this->seedProducts();
            $this->seedUsersAndSellers();
            
            
            header('Location: /');
        }

        public function createDb()
        {
            $this->createTableCategories();
            $this->createTableStates();
            $this->createTableUsers();  
            $this->createTableSellers();
            $this->createTableProducts();
            $this->createTableProductImages();
            $this->createTableCarouselImages();
            $this->createTableOrder();
            $this->createTableOrderItens();
        }

        public function destroyDatabase()
        {   
            try{
                $this->conn->exec("drop table if exists Categories");
                $this->conn->exec("drop table if exists Sellers");
                $this->conn->exec("drop table if exists States");
                $this->conn->exec("drop table if exists OrderItens");
                $this->conn->exec("drop table if exists Order");
                $this->conn->exec("drop table if exists ProductsImages");
                $this->conn->exec("drop table if exists Products");
                $this->conn->exec("drop table if exists CarouselImages");
                $this->conn->exec("drop table if exists Users");
            }
            catch(Exception $ex)
            {
                echo "Ocorreu um erro ao tentar destruir o banco de dados.";
                var_dump($ex);
            }
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

        public function createTableCategories()
        {
            $query = "CREATE TABLE Categories (
                CategoryId int NOT NULL AUTO_INCREMENT,
                Title varchar(255) NOT NULL,    
                Image varchar(100),    
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
                Sku varchar(45) not null,
                UserId int not null,
                FOREIGN KEY(UserId) REFERENCES Users(UserId)
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

        

      
        
        

        public function createTableSellers()
        {
            $this->conn->exec(
                "CREATE TABLE Sellers (
                    SellerId int NOT NULL AUTO_INCREMENT,
                    PRIMARY KEY(SellerId),
                    LastName varchar(255),
                    Age int,    
                    CPF varchar(14),
                    CEP varchar(8),
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
                    Total int NOT NULL , 
                    CreatedAt datetime NOT NULL , 
                    UserId int NOT NULL ,
                    FOREIGN KEY(UserId) REFERENCES Users(UserId) NOT NULL ,
                    StateId int NOT NULL ,
                    FOREIGN KEY(StateId) REFERENCES States(StateId) NOT NULL ,
                    CardOwnerName varchar(150) NOT NULL ,
                    ExpirationMonth int NOT NULL ,
                    ExpirationYear int NOT NULL ,
                    Name varchar(150) NOT NULL ,
                    Address varchar(150) NOT NULL ,
                    Neighborhood varchar(150) NOT NULL ,
                    CPF varchar(14) NOT NULL ,
                    CEP varchar(8) NOT NULL ,                
                    City varchar(150) NOT NULL, 
                    Complement varchar(150) NOT NULL
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
create table Author
(
ssn varchar(11), 
name varchar(40), 
address varchar(100),
phone varchar(12),   
CONSTRAINT pk_author_id
primary key (ssn)
);
create table Book
 ( 
 ISBN varchar(15), 
 title varchar(100), 
 year SMALLINT, 
 price decimal(6,2),
 publisher varchar(40),
 CONSTRAINT PK_book_id  PRIMARY KEY (ISBN)
  );     			
create table Customer ( 
username varchar(40),
 address varchar(100),
 email varchar(50), 
 phone varchar(12), 
 password varchar(100),
 CONSTRAINT PK_USERNAME primary key(username)
 );  
 create table Warehouse ( 
warehouseCode varchar(10),
name varchar(40),
address varchar(100),
phone varchar(12),
constraint pk_warehousecode
primary key (warehouseCode)
 );  
 
create table WrittenBy 
( ssn varchar(11), 
ISBN  varchar(15),    
CONSTRAINT FK_ssn FOREIGN KEY(ssn) references Author(ssn),
CONSTRAINT FK_ISBN foreign key (ISBN) references Book(ISBN)
);
                               			
  
create table Stocks ( 
ISBN varchar(15),
warehouseCode varchar(10),
number int,
CONSTRAINT FK_ISBN_stock foreign key (ISBN) references Book(ISBN),
CONSTRAINT FK_warehousecode foreign key (warehouseCode) references Warehouse(warehouseCode)
);
                    		
  	

create table ShoppingBasket ( 
basketID varchar(13), 
username varchar(40),
constraint PK_shoppingBasket primary key (basketID),
constraint fk_uname foreign key(username) references Customer(username)
);   
              			
create table Contains ( 
ISBN varchar(15), 
basketID varchar(13), 
number int,
constraint pk_contains primary key (ISBN, basketID),
constraint fk_contains_isbn foreign key (ISBN) references Book(ISBN),
constraint fk_containsbasket foreign key (basketID) references ShoppingBasket(basketId)
);      
                 		
create table ShippingOrder 
(ISBN varchar(15), 
warehouseCode varchar(10),
username varchar(40),
number int,
constraint pk_shippingorder primary key (ISBN, warehouseCode),
constraint fk_shippingorderbook foreign key (ISBN) references Book (ISBN),
constraint fk_shippingorderwarehouse foreign key (warehouseCode) references Warehouse(warehouseCode) );  								
                   


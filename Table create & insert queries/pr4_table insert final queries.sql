insert into Author values ("12345678910", "Sam Harris", "Add1, zip1","111111111");
insert into Author values ("12345678911", "Tim Ferris", "Add2, zip2","222222222");
insert into Author values ("12345678912", "Eric Ries", "Add3, zip3","3333333333");
insert into Author values ("12345678913", "Ramit Sethi", "Add4, zip4","4444444444");

insert into Book values ("ISBN1","Title1","1972","100.50","Publisher1");  
insert into Book values ("ISBN2","Title2","1973","99.50","Publisher2");  
insert into Book values ("ISBN3","Title3","1974","90.50","Publisher3");  
insert into Book values ("ISBN4","Title4","1975","70.50","Publisher4");  

insert into Customer values ("user1","add-x,zip-x","email1@mailbox.com","12345678",md5("pwd1"));
insert into Customer values ("user2","add-y,zip-y","email2@mailbox.com","78454546",md5("pwd2"));
insert into Customer values ("user3","add-xy,zip-xy","email3@mailbox.com","12345678",md5("pwd4"));
insert into Customer values ("user4","add-x,zip-xyz","email4@mailbox.com","11111111",md5("pwd4"));

INSERT INTO Warehouse VALUES (1,'warehouse1','loc1, US','12345678');
INSERT INTO Warehouse VALUES (2,'warehouse2','loc2, US','12345679');
INSERT INTO Warehouse VALUES (3,'warehouse3','loc3, US','12345678');
INSERT INTO Warehouse VALUES (4,'warehouse4','loc4, US','12345678');

insert into WrittenBy values("12345678910","ISBN1");
insert into WrittenBy values("12345678911","ISBN2");
insert into WrittenBy values("12345678912","ISBN3");
insert into WrittenBy values("12345678913","ISBN4");

insert into Stocks values ("ISBN1","1",10);                    		
insert into Stocks values ("ISBN2","2",2);
insert into Stocks values ("ISBN3","3",6);
insert into Stocks values ("ISBN4","4",7);

insert into ShoppingBasket values("1","user1");  
insert into ShoppingBasket values("2","user2");             			
insert into ShoppingBasket values("3","user3");
insert into ShoppingBasket values("4","user4");  

insert into Contains values ("ISBN1","1",1);     
insert into Contains values ("ISBN2","2",2);            		
insert into Contains values ("ISBN3","3",3);
insert into Contains values ("ISBN4","4",4);

insert into ShippingOrder values("ISBN1","1","user1",1);
insert into ShippingOrder values ("ISBN2","2","user2",1);
insert into ShippingOrder values("ISBN3","3","user3",1);
insert into ShippingOrder values ("ISBN4","4","user4",1);

insert into Customer values ("user5","add-x,zip-x","email1@mailbox.com","12345678",md5("pwd1"));
select * from Customer
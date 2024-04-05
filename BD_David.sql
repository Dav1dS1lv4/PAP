Drop database PAP_david;
Create database PAP_david;
use PAP_david;

Create Table Tipo_utilizador(
id_tipo INT Primary Key auto_increment,
 Tipo_utilizador varchar(50) not null
);

insert into tipo_utilizador (Tipo_utilizador) values ("Cliente"), ("Admin"), ("Fornecedor"); 

Create Table Tipo_Produto(
id_tipo INT Primary Key auto_increment,
Tipo_Produto varchar(50) not null
);
insert into Tipo_Produto(Tipo_Produto) values ("Redragon"),("Peças"), ("Razer"), ("Corsair");


Create Table Utilizador( 
    id int primary key auto_increment, 
nome varchar(9) not null, 
email varchar(100) not null,
pass varchar(50)not null,
morada varchar(150) not null,
codigo_postal varchar(8) not null,
id_tipo INT Not null,
Foreign key(id_tipo) references Tipo_utilizador(id_tipo)
);  

Create Table Compras(
id_compra INT Primary key auto_increment,
Dataa  varchar(10) not null,
Total numeric(6,2)not null,
id_ut int not null, 
Foreign key(id_ut) references Utilizador(id)
);

Create Table Produto(
id_produto int primary key auto_increment,
nome varchar(500) Not null,
preco numeric(6,2) NOt Null,
img varchar(50) not null, 
id_tipo int not  null,
pagina varchar(100) not null, 
Foreign key(id_tipo) references Tipo_Produto(id_tipo)
);

insert into Produto(Nome, preco, img, id_tipo, pagina) 
values ("Kraken Pro V2",50.00,"krakenprov2.png",1,"krakenpro.php"),
("Deatheadder Elite",25.00,"deatheadderelite.png",1,"deatheadderelite.php"),
("Blackwidow V4",300.00,"razer-blackwidowv4.png",1,"blackwidow.php"),
("M65 RGB Ultra Wireless",55.00,"mouse-m65.png",1,"msg.php"),
("HS80 RGB Wireless",130.00,"corsair-headset.png",1, "hs80.php"),
("k70 PRO MINI WIRELESS",190.00,"teclado-corsair.png",1, "k70.php"),
("M908 Impact MMO Gaming",40.00,"reddragon-mouse.png",1, "m908.php"),
("H510 Zeus-X RGB Wireless",50.00,"reddragon-headset.png",1, "h510.php"),
("k617 FIZZ 60% Wired RGB",60.70,"redragon-keyboard.png",1,  "k617.php"),
("SSD Kingston A400 480Gb",18.60,"ssd.png",2, "ssd.php"),
("Kingston Fury Beast (RAM)",45.00,"ram.png",2,"ram.php"),
("AMD Ryzen Threadripper 3970X",760.00,"processador.png", 2,"processador.php"),
("Rog Maximus Z690 Extreme Glacial",1200.00,"motherboard.png",2,"placa-mae.php"),
("AX1600i Digital ATX",560.00,"fonte.png",2, "fonte.php"),
("SEAGATE 4TB BARRACUDA",70.00,"hd.png", 2, "hdd.php"),
("XXL E-Atx MARS GAMING Mcv3",75.00,"gabinete.png", 2, "gabinete.php"),
("Noctua NF-A12X25-PWM",32.00,"cooler.png",2, "cooler.php"),
("One360 Preto Liquid Cpu Cooling",85.00,"water-cooler.png", 2, "w-cooler.php");
;


create table linhas_compra(
id_compra int,
id_produto int,
quantidade int not null,
primary key(id_compra, id_produto),
Foreign key(id_compra)references Compras(id_compra),
Foreign key(id_produto)references Produto(id_produto)
); 
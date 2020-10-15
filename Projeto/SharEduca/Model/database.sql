create database if not exists SharEduca;
use SharEduca;

create table if not exists Usuario(
id int primary key auto_increment,
nome varchar(200) not null,
email varchar(250) unique not null,
senha varchar(50) not null
);

create table if not exists Conteudo(
id int primary key auto_increment,
nome varchar(200) not null
);

create table if not exists Item(
id int primary key auto_increment,
conteudo int,
nome varchar(250) not null,
valor double(5,2) default 0.0,
constraint FK_id_Conteudo_Item foreign key (conteudo) references Conteudo(id)
);

create table if not exists Carrinho(
id int primary key auto_increment,
usuario int unique,
constraint FK_id_Usuario foreign key (usuario) references Usuario(id)
);

create table if not exists Item_Carrinho(
id int primary key auto_increment,
carrinho int,
item int,
constraint FK_id_Carrinho foreign key (carrinho) references Carrinho(id),
constraint FK_id_Item foreign key (item) references Item(id)
);

delimiter $$
create procedure Colocar_Item(n_car int, n_item int)
begin
	declare repetido int;
    select count(item) into repetico from Item_Carrinho where carrinho like n_car;
    
    if repetido not like 0 then
		insert into Item_Carrinho(carrinho, item) values (n_car, n_item);
	end if;
end $$
delimiter ;

delimiter $$
create procedure Limpar_Carrinho(n_car int)
begin
	delete from Item_Carrinho where carrinho like n_car;
end $$
delimiter ;

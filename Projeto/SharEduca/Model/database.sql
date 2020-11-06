create database if not exists SharEducaDB;
use SharEducaDB;

create table if not exists Usuario(
id int primary key auto_increment,
nome varchar(200) not null,
email varchar(250) unique not null,
senha varchar(50) not null,
acesso int default 0
);

create table if not exists Conteudo(
id int primary key auto_increment,
nome varchar(200) not null,
descrip varchar(500) default "Sem descrição",
img varchar(80) not null default "logo.jpg" #experimental
);

create table if not exists Item(
id int primary key auto_increment,
conteudo int default 0,
nome varchar(250) not null,
tipo varchar(10) not null,
tamanho int not null,
descrip varchar(500) default "Sem descrição",
valor double(5,2) default 0.0,
constraint FK_id_Conteudo_Item foreign key (conteudo) references Conteudo(id)
)engine = MyISAM;

create table if not exists Carrinho(
id int primary key auto_increment,
usuario int unique,
constraint FK_id_Usuario foreign key (usuario) references Usuario(id)
);

create table if not exists Item_Carrinho(
id int primary key auto_increment,
carrinho int not null,
item int not null,
constraint FK_id_Carrinho foreign key (carrinho) references Carrinho(id),
constraint FK_id_Item foreign key (item) references Item(id)
);

delimiter $$
create procedure add_ItemCarrinho(n_cart int, n_item int)
begin
	declare verifica int;
    select count(item) into verifica from Item_Carrinho where 
		carrinho = n_cart and item = n_item;
    
    if verifica like 0 then
		insert into Item_Carrinho(carrinho, item) values (n_cart, n_item);
	end if;
end $$
delimiter ;

delimiter $$
create procedure clear_ItemCarrinho(n_cart int)
begin
	delete from Item_Carrinho where carrinho like n_cart limit 500;
end $$
delimiter ;

delimiter $$
create procedure remove_ItemCarrinho(n_cart int, n_item int)
begin
	delete from Item_Carrinho 
		where carrinho like n_cart and
        item like n_item
        limit 1;
end $$
delimiter ;

#----------Testes----------#

select * from Usuario;
select * from Conteudo;
select * from Item;
select * from Carrinho;
select * from Item_Carrinho;

select * from Conteudo where nome like "Inglês";

insert into Usuario values
(10,"Robson","botlike@","1234",1),
(12,"Miriam","moonlight@","qwert",0);
insert into Conteudo values
(1,"Português","Aprenda a língua natal dos brasileiros com este conteúdo completo.","ex-book.jpg"),
(2,"Inglês","Problemas com o inglês enferrujado? Esta série de conteúdos pode mudar a situação","ex-ing.jpg");
insert into Item values
(1,1,"Pontuação - Teoria","jpeg",50000,"Conteúdo sobre o uso da pontuação.",15.90),
(2,1,"Exercício de Pontuação","pdf",15000,"Excercícios práticos sobre pontuação.",19.90),
(3,2,"Verb To Be","png",65000,"Introdução ao verbo To Be.",16.50),
(4,2,"Exercício: Verb To Be","pdf",30000,"Exercícios: Verb To Be.",18.00);
insert into Carrinho values
(1001,10),
(1002,12);

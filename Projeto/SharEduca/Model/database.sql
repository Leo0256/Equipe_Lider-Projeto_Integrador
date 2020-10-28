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
conteudo int default 0,
nome varchar(250) not null,
tipo varchar(10) not null,
tamanho int not null,
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
carrinho int,
item int,
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
create procedure Limpar_Carrinho(n_cart int)
begin
	delete from Item_Carrinho where carrinho like n_cart limit 500;
end $$
delimiter ;

delimiter $$
create procedure Remover_Item(n_cart int, n_item int)
begin
	delete from Item_Carrinho 
		where carrinho like n_cart and
        item like n_item
        limit 1;
end $$
delimiter ;

insert into Usuario values
(1, "Miriam", "botlike@", "1234");

insert into Conteudo values
(1, "Português"),
(2, "Inglês");

select id from Conteudo where nome like "Inglês";

insert into Carrinho values
(101, 1);

select * from Item_Carrinho;
select * from Item;
select * from Conteudo where nome = "Português";

update Item set conteudo = 1, tipo = "jpeg" where id like 1 limit 1;
insert into Item(nome, valor) values ("teste", 42);

truncate table Item;

call Colocar_Item(101,1001);
call Limpar_Carrinho(101);
call Remover_Item(101,1001);

drop database shareduca;
drop procedure colocar_item;
drop procedure limpar_carrinho;
drop procedure remover_item;
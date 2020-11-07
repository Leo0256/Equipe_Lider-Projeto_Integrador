# Sprint 2

-----------------------------------------------------------------------------------------------------------------------------------------------

## Objetivo
Possibilitar ao cliente a venda do conteúdo acadêmico já disponibilizado. 

-----------------------------------------------------------------------------------------------------------------------------------------------

## Valores entregues (Com base nos requisitos):

- Implantação do banco de dados;
- Implementação do banco de dados;
- Conteúdo (Inglês PDF- Exercícios);
- Conteúdo (Língua Portuguesa PDF- Concordância);
- Conteúdo (Matemática Discreta- Grafos e Lógica);
- Conteúdo (Língua Portuguesa- Vídeos de concordância e pontuação);
- Conteúdo (Laboratório de Hardware- Introdução ao Computador);
- Layout Página inicial;
- Layout do carrinho de compras;
- Layout Login;
- Layout do conteúdo.



----------------------------------------------------------------------------------------------------------------------------------------------------------
## Implantação do Banco de dados:

### Dicionário de dados 

![DDADOS](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/DDADOS.png)

----------------------------------------------------------------------------------------------------------------------------------------------------------
## Implementação do banco de dados: 


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

insert into Usuario values
(10,"Robson","botlike@","1234",1),
(12,"Miriam","moonlight@","qwert",0);
insert into Conteudo values
(1,"Português","Decrição do conteúdo de Língua Portuguêsa.","lp.jpg"),
(2,"Inglês","Descrição do conteúdo de Inglês.","ing.jpg"),
(3,"Matemática Discreta","math.jpg"),
(4,"Laboratório de Hardware","lab-hard.jpg");

insert into Item values
(1,1,"Pontuação - Teoria","jpeg",50000,"Conteúdo sobre o uso da pontuação.",15.90),
(2,1,"Exercício de Pontuação","pdf",15000,"Excercícios práticos sobre pontuação.",19.90),
(3,2,"Verb To Be","png",65000,"Introdução ao verbo To Be.",16.50),
(4,2,"Exercício: Verb To Be","pdf",30000,"Exercícios: Verb To Be.",18.00);
insert into Carrinho values
(1001,10),
(1002,12);

----------------------------------------------------------------------------------------------------------------------------------------------------------
## Prévia dos Exercícios de Inglês (Conteúdo na íntrega em formato PDF). 

![exerc.ingles1](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/ING/exerc.ingles1.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![exerc.ingles2](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/ING/exerc.ingles2.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![exerc.ingles3](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/ING/exerc.ingles3.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![exerc.ingles4](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/ING/exerc.ingles4.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

## Prévia do Conteúdo de Língua Portuguesa - Concordância (Conteúdo na íntrega em formato PDF). 

![LPC1](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/LP/LPC1.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![LPC2](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/LP/LPC2.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![LPC3](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/LP/LPC3.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![LPC4](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/LP/LPC4.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

## Prévia do Conteúdo de Matemática Discreta- Grafos (Conteúdo na íntrega em formato PDF). 

![GRAFOS01](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/GRAFOS01.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![GRAFOS02](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/GRAFOS02.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![GRAFOS03](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/GRAFOS03.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![GRAFOS04](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/GRAFOS04.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

## Prévia do Conteúdo de Matemática Discreta- Lógica (Conteúdo na íntrega em formato PDF). 

![LG1](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/LG1.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![LG2](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/LG2.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![LG3](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/LG3.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![LG4](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/LG4.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------
## Prévia de Língua Portuguesa- Vídeos de concordância e pontuação (Conteúdo na íntrega em formato ?). 

![nome da imagem na pasta](link da imagem na pasta)


----------------------------------------------------------------------------------------------------------------------------------------------------------

 ## Prévia do Conteúdo de Laboratório de Hardware- Introdução ao Computador (Conteúdo na íntrega em formato PDF). 

![LAB_HARD_INTRO_PC1](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/LabHard/LAB_HARD_INTRO_PC1.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![LAB_HARD_INTRO_PC2](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/LabHard/LAB_HARD_INTRO_PC2.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![LAB_HARD_INTRO_PC3](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/LabHard/LAB_HARD_INTRO_PC3.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

![LAB_HARD_INTRO_PC4](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/Conteudos/LabHard/LAB_HARD_INTRO_PC4.jpg)

----------------------------------------------------------------------------------------------------------------------------------------------------------

## GIF do layout da página inicial, carrinho de compras e login:

![GIF_Layout_Site_SharEduca.gif](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/GIF_Layout_Site_SharEduca.gif)
 
 ### GIF do menu de conteúdo:
 
![GIFCONTEUDOS](https://github.com/Leo0256/Equipe_Lider-Projeto_Integrador/blob/master/Projeto/Documentos/Imagens/GIFCONTEUDOS.gif)
----------------------------------------------------------------------------------------------------------------------------------------------------------
 

 

 



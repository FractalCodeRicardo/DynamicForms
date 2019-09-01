create database dynamic_forms


use dynamic_forms;


create table if not exists forms(
    id int not null AUTO_INCREMENT,
    description varchar(100) not null,
    primary key (id))


create table if not exists types(
    id varchar(10) not null,
    description varchar(100) not null,
    primary key (id))



create table if not exists columns(
    id varchar(10) not null,
    description varchar(100) not null,
    id_type varchar(10) not null,
    id_form int not null,
    name varchar(50) not null,
    primary key (id))



alter table columns
add constraint FK_columns_types foreign key (id_type) references types (id)

alter table columns
add constraint FK_columns_forms foreign key (id_form) references forms (id)


ALTER TABLE columns MODIFY COLUMN id INT auto_increment
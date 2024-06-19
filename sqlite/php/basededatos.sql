create table if not exists productos(
 id integer primary key autoincrement,
    nombre varchar(30),
    categoria varchar(10),
    descripcion varchar(50),
    stock integer,
    precio float,
    
);



create table if not exists distribuidores(
    id integer primary key autoincrement,
    nombre varchar(30),
    telefono varchar(10),
    direccion varchar(30),
    correo varchar(30),
    
);




create table if not exists ventas(
    id integer primary key autoincrement,
    nombre varchar(30),
    categoria varchar(10),
    precio float,
    cantidad integer,
    total float,

    
);


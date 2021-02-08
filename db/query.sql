create table cabezera(
idCabezera int(11) auto_increment,
cedula varchar(11),
nombre varchar(30),
direccion varchar(30),
telefono varchar(20),
eliminar int(2),
constraint idCabezera_pk primary key (idCabezera)
);


create table detalle (
    idDetalle int(11) auto_increment,
    nombreProducto varchar(50),
    cantidad int(11),
    precio double(10,2),
    iva double(10,2),
    porcentajeIva double(10,2),
    subtotal double(10,2),
    total double(10,2),
    idCabezera int(11),
    eliminar int (2),
    constraint idDetalle_pk primary key (idDetalle),
    constraint  idCabezera_fk foreign key (idCabezera) references cabezera(idcabezera)
);
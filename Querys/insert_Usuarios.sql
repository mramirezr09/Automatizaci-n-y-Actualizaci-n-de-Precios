use proyecto_adg;

insert into proyecto_adg.`adg.usuarios`(
	FK_IdEmpresa,
	FK_IdArea,
	FK_IdDepartamento,
	Nombre_Usuario,
	Apaterno,
	Amaterno,
	Login,
	Pass,
	Status,
	Fecha_Actualiza
)
values(
    1,
    3,
    1,
    'ADG',
    'COMPRAS',
    'COSTOS',
    'ACC01',
    '123456789asd+',
    1,
    '2022/02/20 15:01:00'
);

delete from proyecto_adg.`adg.empresa` where pk_idempresa = null;
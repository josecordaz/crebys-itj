a!--Procedimientos
a	!-- PARTIDAS

	!-- Inserción de Partida
		!-- error 0:=	Error en la consulta;
		!-- error 1:=	Inserción correcta;
		!-- error 2:=	Ya existe la partida;

	&CREATE PROCEDURE insPartida(IN Id_Partid INT,IN Pa_Nombr VARCHAR(30),OUT error INT)
	BEGIN
		SET error=1;
		IF(select count(*)from Partidas where Id_Partida=Id_Partid)>0 THEN
			SET error=2;
		ELSE
			INSERT INTO Partidas VALUES(Id_Partid,Pa_Nombr);
		END IF;
	END;&
		
	!-- Modificar nombre de Partida
		!-- error 0:=	Error en la consulta;
		!-- error 1:=	Modificacion correcta;
		!-- error 2:=	No se encontró la partida busca;

	&CREATE PROCEDURE modPartida(IN Id_Partid INT,IN Pa_Nombr VARCHAR(30),OUT error INT)
	BEGIN
		SET error=1;
		IF(select count(Id_Partida) from Partidas where Id_Partida=Id_Partid)>0 THEN
			BEGIN
				UPDATE Partidas set Pa_Nombre=Pa_Nombr where Id_Partida=Id_Partid;
			END;
		ELSE
			SET error=2;
		END IF;
	END;&
	
	!-- Eliminar Partida
		!-- error 0:= Error en la consulta;
		!-- error 1:= Eliminación perfecta;
		!-- error 2:= Existen insumos relacionados con la partida: Id_Partid
		!-- error 3:= No existe la partida
		
	&CREATE PROCEDURE eliPartida(IN Id_Partid INT,OUT error INT)
	BEGIN
		SET error=1;
		IF (select count(*) from Partidas where Id_Partida=Id_Partid)>0 THEN
			IF (select count(*) from Insumos where Id_Partida=Id_Partid)>0 THEN
					SET error=2;
			ELSE
					delete from Partidas where Id_Partida=Id_Partid;
			END IF;
		ELSE
			SET error=3;
		END IF;
	END;&
	

!-- INSUMOS

	!-- Inserción de Insumo
		!-- error 0:= Error en la consulta;
		!-- error 1:= Insersion exitosa;
		!-- error 2:= Ya existe el insumo: In_Nombr
		!-- error 3:= La partida Id_Partid no existe
		
	&CREATE PROCEDURE insInsumo(IN In_Nombr VARCHAR(100),IN In_Preci DOUBLE,IN In_Unidad VARCHAR(20),IN Id_Partid INT,OUT error INT)
	BEGIN
		DECLARE Id_Insum INT default(0);
		SET error=1;
		IF(select count(*) from Insumos)>0 THEN
			SET Id_Insum=(select max(Id_Insumo) from Insumos)+4;
		ELSE
			SET Id_Insum=50;
		END IF;
		IF(select count(*) from Insumos where In_Nombre=In_Nombr)>0 THEN
			SET error=2;
		ELSE
			IF (select count(*) from Partidas where Id_Partida=Id_Partid)>0 THEN
				insert into Insumos values(Id_Insum,In_Nombr,In_Preci,In_Unidad,Id_Partid);
			ELSE
				SET error=3;
			END IF;
		END IF;
	END;&
	
	!-- Modificación de Insumo
		!-- 0 error de consulta
		!-- 1 modificación correcta
		!-- 2 no existe el Id_Insumo proporcionado
		!-- 3 no existe la partida Id_Partida
	
	&CREATE PROCEDURE modInsumo(IN Id_Insum INT,IN In_Nombr VARCHAR(100),IN In_Preci DOUBLE,IN In_Unidad VARCHAR(20),IN Id_Partid INT,OUT error INT)
	BEGIN
		SET error=1;
		IF(select count(*) from Insumos where Id_Insumo=Id_Insum)=0 THEN
			SET error=2;
		ELSE
			If(select count(*) from Partidas where Id_Partida=Id_Partid)>0 THEN
				update Insumos set In_Nombre=In_nombre,In_Precio=In_Preci,In_Unidad_M=In_Unidad,Id_Partida=Id_Partid where Id_Insumo=Id_Insum;
			ELSE
				SET error=3;
			END IF;
		END IF;
	END;&
	
	!-- Eliminar Insumo
		!-- 0 error en la consulta
		!-- 1 eliminación correcta
		!-- 2 no existe el insumo Id_Insumo
		!-- 3 no se puede eliminar poque existen registros relacionados con ese Id_Insumo en la tabla insumos_acciones
	
	&CREATE PROCEDURE eliInsumo(IN Id_Insum INT,OUT error INT)
	BEGIN
		SET error=1;
		IF(select count(*) from Insumos where Id_Insumo=Id_Insum)=0 THEN
			SET error=2;
		ELSE
			IF(select count(*) from insumos_acciones where Id_Insumo=Id_Insum)=0 THEN
				delete from Insumos where Id_Insumo=Id_Insum;
			ELSE
				SET error=3;
			END IF;
		END IF;
	END;&
	
!--PROCESOS ESTRATÉGICOS

	!-- Insertar Proceso Estratégico
		!-- error 0 error de consulta
		!-- error 1 inserción correcta
		!-- error 2 ya existe ese proc-est. Pe_Nombre
	&CREATE PROCEDURE insProc_Estrategico(IN Pe_Nombr VARCHAR(30),OUT error INT)
	BEGIN
		DECLARE Id_Proc_Estrategic INT default(0);
		SET error=1;
		IF(select count(*) from proc_estrategicos)>0 THEN
			SET Id_Proc_Estrategic=(select max(Id_Proc_Estrategico) from proc_estrategicos)+7;
		ELSE
			SET Id_Proc_Estrategic=60;
		END IF;
		IF(select count(*) from proc_estrategicos where Pe_Nombre=Pe_Nombr)>0 THEN
			SET error=2;
		ELSE
			insert into proc_estrategicos values(Id_Proc_Estrategic,Pe_Nombr);
		END IF;
	END;&
	
	!-- Modificar Proceso Estratégico
		!-- error 0 Error de consulta
		!-- error 1 Modificación correcta
	&CREATE PROCEDURE modProc_Estrategico(IN Id_Proc_Estrategic INT,IN Pe_Nombr VARCHAR(30),OUT error INT)
	BEGIN
		SET error=1;
		update Proc_Estrategicos set Pe_Nombre=Pe_Nombr where Id_Proc_Estrategico=Id_Proc_Estrategic;
	END;&
	
	!-- Validamos los datos de sesión
		!-- error 0 Error en la consulta
		!-- error 1 Los datos son correctos
		!-- error 2 No existe el usuario
		!-- error 3 Contraseña incorrecta
		
	&CREATE PROCEDURE iniciarSesion(IN Us_Nic varchar(25),IN Us_Passwor varchar(32),OUT error INT)
	BEGIN
		IF(select count(*) from usuarios where Us_Nick=Us_Nic)>0 THEN
			IF(select count(*) from usuarios where Us_Nick=Us_Nic and Us_Password=Us_Passwor)>0 THEN
				SET error=1;
			ELSE
				SET error=3;
			END IF;
		ELSE
			SET error=2;	
		END IF;
	END;&
	
	!-- Conocemos que puesto tiene el usuario de entrada
	&CREATE PROCEDURE saberTipoUsuario(IN Us_Nic varchar(25),OUT tipo varchar(15))
	BEGIN
		set tipo=(select Pu_Nombre 
			      from puestos 
					inner join( 
						departamentos_puestos 
							inner join usuarios on usuarios.Id_Departamento_Puesto=departamentos_puestos.Id_Departamento_Puesto
					) on departamentos_puestos.Id_Puesto=puestos.Id_Puesto
					  where Us_Nick=Us_Nic);
	END;&
	
	!-- Insertamos un nuevo usuario
		!-- error 0 Error en consulta
		!-- error 1 Inserción correcta
		!-- error 2 Nick repetido
		!-- error 3 Nombre repetido
		!-- error 4 Puesto inexistente
		!-- error 5 Departamento inexistente
		!-- error 6 Ya existe un usuario se creó el usuario jefe para este departamento
		
	&CREATE PROCEDURE insUsuario(IN Id_Departamento_Puest INT,IN Us_Passwor VARCHAR(32),IN Us_Nombr VARCHAR(25), IN Us_Apellido_p VARCHAR(15),IN Us_Apellido_m VARCHAR(15),IN Us_Nic VARCHAR(20),IN Id_Puest INT,IN Id_Departament INT,OUT error INT)
	BEGIN
		DECLARE Id_Usuari INT default(0);
		DECLARE Id_Departamento_Puest INT default(0);
		
		SET error=1;
		
		IF(select count(*) from usuarios for update)>0 THEN
			SET Id_Usuari=(select max(Id_Usuario) from usuarios)+3;
		ELSE
			SET Id_Usuari=20;
		END IF;
		
		IF(select count(*) from Departamentos_Puestos)>0 THEN
			SET Id_Departamento_Puest=(select max(Id_Departamento_Puesto) from Departamentos_Puestos)+5;
		ELSE
			SET Id_Departamento_Puest=50;
		END IF;
		
		IF(select count(*) from usuarios where Us_Nick=Us_Nic)=0 THEN
			IF(select count(*) from usuarios where Us_Nombre=Us_Nombr AND Us_Apellidop=Us_Apellido_p AND Us_Apellidom=Us_Apellido_m)=0 THEN
				IF(select count(*) from puestos where Id_Puesto=Id_Puest)>0 THEN
					IF(select count(*) from departamentos where Id_Departamento=Id_Departament)>0 THEN
						If(select count(*) from departamentos_puestos where Id_Departamento=Id_Departament and Id_Puesto=Id_Puest)=0 THEN
							BEGIN
								START TRANSACTION;
									insert into usuarios values(Id_Usuari,Id_Departamento_Puest,Us_Passwor,Us_Nombr,Us_Apellido_p,Us_Apellido_m,Us_Nic);
									insert into departamentos_puestos values(Id_Departamento_Puest,Id_Puest,Id_Departament);
								COMMIT;
							END;
						ELSE
							SET error=6;
						END IF;
					ELSE
						SET error=5;
					END IF;
				ELSE
					SET error=4;
				END IF;
			ELSE
				SET error=3;
			END IF;
		ELSE
			SET error=2;
		END IF;
	END;&

	!-- Saber nombre del departamento a partir del nick
	&CREATE PROCEDURE saberDepartamento(IN)
	END&
		
	
CREATE PROCEDURE insPartida(IN Id_Partid INT,IN Pa_Nombr VARCHAR(30),OUT error INT)
	BEGIN
		SET error=1;
		IF(select count(*)from Partidas where Id_Partida=Id_Partid)>0 THEN
			SET error=2;
		ELSE
			INSERT INTO Partidas VALUES(Id_Partid,Pa_Nombr);
		END IF;
	END;


CREATE PROCEDURE modPartida(IN Id_Partid INT,IN Pa_Nombr VARCHAR(30),OUT error INT)
	BEGIN
		SET error=1;
		IF(select count(Id_Partida) from Partidas where Id_Partida=Id_Partid)>0 THEN
			BEGIN
				UPDATE Partidas set Pa_Nombre=Pa_Nombr where Id_Partida=Id_Partid;
			END;
		ELSE
			SET error=2;
		END IF;
	END;


CREATE PROCEDURE eliPartida(IN Id_Partid INT,OUT error INT)
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
	END;


CREATE PROCEDURE insInsumo(IN In_Nombr VARCHAR(100),IN In_Preci DOUBLE,IN In_Unidad VARCHAR(20),IN Id_Partid INT,OUT error INT)
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
	END;


CREATE PROCEDURE modInsumo(IN Id_Insum INT,IN In_Nombr VARCHAR(100),IN In_Preci DOUBLE,IN In_Unidad VARCHAR(20),IN Id_Partid INT,OUT error INT)
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
	END;


CREATE PROCEDURE eliInsumo(IN Id_Insum INT,OUT error INT)
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
	END;


CREATE PROCEDURE insProc_Estrategico(IN Pe_Nombr VARCHAR(30),OUT error INT)
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
	END;


CREATE PROCEDURE modProc_Estrategico(IN Id_Proc_Estrategic INT,IN Pe_Nombr VARCHAR(30),OUT error INT)
	BEGIN
		SET error=1;
		update Proc_Estrategicos set Pe_Nombre=Pe_Nombr where Id_Proc_Estrategico=Id_Proc_Estrategic;
	END;


DELIMITER &

CREATE PROCEDURE insPartida(IN Id_Partid INT,IN Pa_Nombr VARCHAR(30),OUT error INT)
	BEGIN
		SET error=1;
		IF(select count(*)from Partidas where Id_Partida=Id_Partid)>0 THEN
			SET error=2;
		ELSE
			INSERT INTO Partidas VALUES(Id_Partid,Pa_Nombr);
		END IF;
	END;


CREATE PROCEDURE modPartida(IN Id_Partid INT,IN Pa_Nombr VARCHAR(30),OUT error INT)
	BEGIN
		SET error=1;
		IF(select count(Id_Partida) from Partidas where Id_Partida=Id_Partid)>0 THEN
			BEGIN
				UPDATE Partidas set Pa_Nombre=Pa_Nombr where Id_Partida=Id_Partid;
			END;
		ELSE
			SET error=2;
		END IF;
	END;


CREATE PROCEDURE eliPartida(IN Id_Partid INT,OUT error INT)
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
	END;


CREATE PROCEDURE insInsumo(IN In_Nombr VARCHAR(100),IN In_Preci DOUBLE,IN In_Unidad VARCHAR(20),IN Id_Partid INT,OUT error INT)
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
	END;


CREATE PROCEDURE modInsumo(IN Id_Insum INT,IN In_Nombr VARCHAR(100),IN In_Preci DOUBLE,IN In_Unidad VARCHAR(20),IN Id_Partid INT,OUT error INT)
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
	END;


CREATE PROCEDURE eliInsumo(IN Id_Insum INT,OUT error INT)
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
	END;


CREATE PROCEDURE insProc_Estrategico(IN Pe_Nombr VARCHAR(30),OUT error INT)
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
	END;


CREATE PROCEDURE modProc_Estrategico(IN Id_Proc_Estrategic INT,IN Pe_Nombr VARCHAR(30),OUT error INT)
	BEGIN
		SET error=1;
		update Proc_Estrategicos set Pe_Nombre=Pe_Nombr where Id_Proc_Estrategico=Id_Proc_Estrategic;
	END;



DELIMITER ;
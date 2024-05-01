CREATE TABLE alumno(
codigo    INT PRIMARY KEY,
     nombre    VARCHAR(50),
     carrera   VARCHAR(50),
     correo    VARCHAR(50)
);

INSERT INTO alumno VALUES('221978256', 'Fierros Casas Diego Armando', 'ICOM', 'diego.fierros7825@gmail.udg.mx');
INSERT INTO alumno VALUES('218569116', 'Diaz Lopez Juan Enrique', 'ICOM', 'juan.diaz5691@alumnos.udg.mx');
INSERT INTO alumno VALUES('218529823', 'Chavez Saucedo Brain Jesus', 'ICOM', 'brain.chavez@alumnos.udg.mx');
INSERT INTO alumno VALUES('219246728', 'De Alba Velarde Chistian Moises', 'ICOM', 'christian.dealba2467@alumnos.udg.mx');
SELECT * FROM alumno;
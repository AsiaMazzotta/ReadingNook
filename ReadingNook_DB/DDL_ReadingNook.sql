CREATE TABLE IF NOT EXISTS Libro(
	PRIMARY KEY(id_libro),
	id_libro 		INT 			GENERATED ALWAYS AS IDENTITY,
	ISBN 			CHAR(13) 		UNIQUE NOT NULL,
	titolo 			VARCHAR(35)		NOT NULL,
	data_rilascio  	DATE 			,	--nullable
	copertina 		VARCHAR(100)	UNIQUE NOT NULL,
	sito 			VARCHAR(300)	UNIQUE NOT NULL,
	lingua			varchar(30)						,
	trama 			VARCHAR(900)	,
	valutazione 	DECIMAL				DEFAULT 0
						CONSTRAINT rating_libro
						CHECK(valutazione >= 0 AND valutazione <= 5 )
	
);

CREATE TABLE IF NOT EXISTS Genere(
	PRIMARY KEY(id_genere),
	id_genere 		INT 		GENERATED ALWAYS AS IDENTITY,
	genere			VARCHAR(30)		NOT NULL
);

--tabella rel(N,N)
CREATE TABLE IF NOT EXISTS	Genere_libro(
	PRIMARY KEY(id_libro,id_genere),
	id_libro 		INT
						REFERENCES Libro(id_libro),
	id_genere 		INT 
						REFERENCES Genere(id_genere)
);


CREATE TABLE IF NOT EXISTS Autore(
	PRIMARY KEY(id_autore),
	id_autore 		INT				GENERATED ALWAYS AS IDENTITY,
	nome 			VARCHAR(30)		NOT NULL,
	cognome			VARCHAR(30)		NOT NULL,
	bio				VARCHAR(900)    		,
	foto			VARCHAR(300)
);

--relazione(N,N)
CREATE TABLE IF NOT EXISTS Autore_libro(
	PRIMARY KEY(id_autore,id_libro),
	id_autore		INT 
						REFERENCES Autore(id_autore),
	id_libro		INT
						REFERENCES Libro(id_libro)
);

CREATE TABLE IF NOT EXISTS Utente(
	PRIMARY KEY(id_utente),
	id_utente 		INT 			GENERATED ALWAYS AS IDENTITY,
	nome 			VARCHAR(30)		NOT NULL,
	cognome 		VARCHAR(30)		NOT NULL,
	ddn				DATE						,
	data_iscrizione DATE 			NOT NULL,
	email 			VARCHAR(150)		UNIQUE NOT NULL
							CONSTRAINT email
							CHECK(email LIKE '%_@_%.__%'),
	pswd 			VARCHAR(255)		NOT NULL,
	country			VARCHAR(30)					,
	city 			VARCHAR(30)					,
	img_profilo		VARCHAR(300) 	DEFAULT '/ReadingNook/images/user.png'
);




--Relationship(1,N)



CREATE TABLE IF NOT EXISTS Recensioni(
	PRIMARY KEY(id_libro,id_utente,valutazione),
	id_libro 			INT 	
							REFERENCES Libro(id_libro),
	id_utente			INT
							REFERENCES Utente(id_utente),
	testo 				VARCHAR(300)	,
	orario				TIMESTAMP		NOT NULL,
	valutazione			DECIMAL			NOT NULL
							CONSTRAINT rating
							CHECK(valutazione >= 0 AND valutazione <= 5)

);




CREATE VIEW Libri_recenti AS
SELECT * FROM Libro
ORDER BY data_rilascio DESC
LIMIT 9;

CREATE VIEW Valutazione AS
SELECT * FROM Libro
WHERE Valutazione = 0 OR Valutazione > 3
ORDER BY valutazione DESC
LIMIT 9;


CREATE VIEW Visualizza_libri AS
SELECT titolo,copertina,valutazione,nome,cognome,lingua
FROM (Libro JOIN Autore_libro ON Libro.id_libro = Autore_Libro.id_libro)
JOIN Autore ON Autore_libro.id_autore = Autore.id_autore;

CREATE VIEW Libri_genere AS
SELECT titolo,copertina,genere,valutazione,lingua
FROM (Libro JOIN Genere_libro ON Libro.id_libro = Genere_libro.id_libro)
JOIN Genere ON Genere.id_genere = Genere_libro.id_genere;

CREATE VIEW Media AS
SELECT id_libro, AVG(valutazione) AS avgscore
FROM recensioni 
GROUP BY id_libro;

CREATE VIEW Raccomandati AS
SELECT titolo, Recensioni.orario
FROM Libro JOIN Recensioni ON Libro.id_libro = Recensioni.id_libro
WHERE Recensioni.valutazione > 3
ORDER BY Recensioni.orario DESC LIMIT 5;



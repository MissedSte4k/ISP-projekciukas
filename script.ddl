--@(#) script.ddl

CREATE TABLE DB schema.Asmuo
(
	asmens_kodas int NOT NULL,
	vardas varchar (255) NOT NULL,
	pavarde varchar (255) NOT NULL,
	PRIMARY KEY(asmens_kodas)
);

CREATE TABLE DB schema.Grafiko_laikas
(
	grafiko_id int NOT NULL,
	grafiko_pradzia timestamp NOT NULL,
	grafiko_pabaiga timestamp NOT NULL,
	PRIMARY KEY(grafiko_id)
);

CREATE TABLE DB schema.Kalejimai
(
	Pavadinimas varchar (255) NOT NULL,
	id_Kalejimas integer NOT NULL,
	PRIMARY KEY(id_Kalejimas)
);

CREATE TABLE DB schema.Klientas
(
	vardas varchar (255),
	id_Klientas integer,
	PRIMARY KEY(id_Klientas)
);

CREATE TABLE DB schema.Konkursas
(
	Pavadinimas varchar (255),
	Aprašymas varchar (255),
	Registravimosi terminas date,
	maksimali kaina float,
	darb? baigimo terminas date,
	paslaug? tiekimo pradžia date,
	paslaug? tiekimo pabaiga date,
	Nugal?tojo paskelbimo data date,
	Aktyvi registracija boolean,
	Konkurso paskelbimo data date,
	R?šis char (17),
	id_Konkursas integer,
	CHECK(R?šis in ('Darb? pirkimas', 'Turto pirkimas', 'Paslaug? pirkimas')),
	PRIMARY KEY(id_Konkursas)
);

CREATE TABLE DB schema.Koridoriai
(
	Pavadinimas varchar (255) NOT NULL,
	Kodas varchar NOT NULL,
	fk_Koridorius varchar NOT NULL,
	PRIMARY KEY(Kodas),
	CONSTRAINT jungia FOREIGN KEY(fk_Koridorius) REFERENCES DB schema.Koridoriai (Kodas)
);

CREATE TABLE DB schema.Patalpa
(
	Id NOT NULL,
	Pavadinimas varchar (255) NOT NULL,
	PRIMARY KEY(Id)
);

CREATE TABLE DB schema.Registracija
(
	Isdavimo_kodas NOT NULL,
	Isdavimo_d date NOT NULL,
	Pridavimo_d date NULL,
	PRIMARY KEY(Isdavimo_kodas)
);

CREATE TABLE DB schema.Rezervacija
(
	pradžia date,
	pabaiga date,
	id_Rezervacija integer,
	PRIMARY KEY(id_Rezervacija)
);

CREATE TABLE DB schema.Blokai
(
	Pavadinimas varchar (255) NOT NULL,
	Kodas varchar NOT NULL,
	Signalizacija boolean NOT NULL,
	fk_Kalejimas integer NOT NULL,
	fk_Koridorius varchar NOT NULL,
	PRIMARY KEY(Kodas),
	CONSTRAINT turi5 FOREIGN KEY(fk_Kalejimas) REFERENCES DB schema.Kalejimai (id_Kalejimas),
	CONSTRAINT jungia1 FOREIGN KEY(fk_Koridorius) REFERENCES DB schema.Koridoriai (Kodas)
);

CREATE TABLE DB schema.Daiktas
(
	Pavadinimas varchar (255) NOT NULL,
	Kodas NOT NULL,
	Gavimo_data date NOT NULL,
	Kaina double precision NOT NULL,
	Spalva varchar (255) NOT NULL,
	Tipas char (0) NOT NULL,
	Bukle char (0) NULL,
	fk_PatalpaId NOT NULL,
	fk_RegistracijaIsdavimo_kodas NOT NULL,
	PRIMARY KEY(Kodas),
	CONSTRAINT priklauso_daiktas FOREIGN KEY(fk_PatalpaId) REFERENCES DB schema.Patalpa (Id),
	CONSTRAINT ?registruotas_daiktas FOREIGN KEY(fk_RegistracijaIsdavimo_kodas) REFERENCES DB schema.Registracija (Isdavimo_kodas)
);

CREATE TABLE DB schema.Dalyvis
(
	Pavadinimas varchar (255),
	Si?loma kaina float,
	Si?loma darb? pradžios data date,
	Si?loma darb? pabaigos data date,
	Laim?tojas boolean,
	Atmestas boolean,
	Atmetimo priežastis varchar (255),
	id_Dalyvis integer,
	fk_Konkursasid_Konkursas integer NOT NULL,
	PRIMARY KEY(id_Dalyvis),
	CONSTRAINT turi FOREIGN KEY(fk_Konkursasid_Konkursas) REFERENCES DB schema.Konkursas (id_Konkursas)
);

CREATE TABLE DB schema.Pamaina
(
	pamainos_id int NOT NULL,
	pavadinimas varchar (255) NOT NULL,
	fk_Grafiko_laikasgrafiko_id int NOT NULL,
	PRIMARY KEY(pamainos_id),
	CONSTRAINT turi_grafika FOREIGN KEY(fk_Grafiko_laikasgrafiko_id) REFERENCES DB schema.Grafiko_laikas (grafiko_id)
);

CREATE TABLE DB schema.Aukstai
(
	Pavadinimas varchar (255) NOT NULL,
	Kodas varchar NOT NULL,
	fk_Blokas varchar NOT NULL,
	PRIMARY KEY(Kodas),
	FOREIGN KEY(fk_Blokas) REFERENCES DB schema.Blokai (Kodas)
);

CREATE TABLE DB schema.Darbuotojas
(
	tabelio_nr int NOT NULL,
	telefono_numeris int NOT NULL,
	gyvenamoji_vieta varchar (255) NOT NULL,
	sutarties_pradzia date NOT NULL,
	sutarties_pabaiga date NOT NULL,
	pareigos char (0) NOT NULL,
	fk_Pamainapamainos_id int NOT NULL,
	fk_Asmuoasmens_kodas int NOT NULL,
	fk_RegistracijaIsdavimo_kodas,
	PRIMARY KEY(tabelio_nr),
	CONSTRAINT turi_pamaina FOREIGN KEY(fk_Pamainapamainos_id) REFERENCES DB schema.Pamaina (pamainos_id),
	CONSTRAINT dirba FOREIGN KEY(fk_Asmuoasmens_kodas) REFERENCES DB schema.Asmuo (asmens_kodas),
	CONSTRAINT registruojamas_darbuotojas FOREIGN KEY(fk_RegistracijaIsdavimo_kodas) REFERENCES DB schema.Registracija (Isdavimo_kodas)
);

CREATE TABLE DB schema.Sutartis
(
	Numeris integer,
	Sudarymo data date,
	Susietas dokumentas boolean,
	Susieto dokumento ID integer,
	fk_Dalyvisid_Dalyvis integer NOT NULL,
	fk_Konkursasid_Konkursas integer NOT NULL,
	PRIMARY KEY(Numeris),
	UNIQUE(fk_Dalyvisid_Dalyvis),
	UNIQUE(fk_Konkursasid_Konkursas),
	CONSTRAINT sudaro FOREIGN KEY(fk_Dalyvisid_Dalyvis) REFERENCES DB schema.Dalyvis (id_Dalyvis),
	CONSTRAINT turi FOREIGN KEY(fk_Konkursasid_Konkursas) REFERENCES DB schema.Konkursas (id_Konkursas)
);

CREATE TABLE DB schema.Kameros
(
	Kodas varchar NOT NULL,
	fk_Aukstas varchar NOT NULL,
	PRIMARY KEY(Kodas),
	CONSTRAINT turi3 FOREIGN KEY(fk_Aukstas) REFERENCES DB schema.Aukstai (Kodas)
);

CREATE TABLE DB schema.Korteles
(
	Isdavimo_data date NOT NULL,
	Galiojimo_data date NOT NULL,
	ID varchar NOT NULL,
	Lygis char (0) NOT NULL,
	fk_Darbuotojastabelio_nr int NOT NULL,
	fk_Darbuotojas NOT NULL,
	PRIMARY KEY(ID),
	UNIQUE(fk_Darbuotojastabelio_nr, fk_Darbuotojas),
	CONSTRAINT turi FOREIGN KEY(fk_Darbuotojastabelio_nr, fk_Darbuotojas) REFERENCES DB schema.Darbuotojas (tabelio_nr)
);

CREATE TABLE DB schema.Vartotojai
(
	id varchar (255) NOT NULL,
	username varchar (255) NOT NULL,
	password varchar (255) NOT NULL,
	email varchar (255) NOT NULL,
	level int NOT NULL,
	fk_Darbuotojastabelio_nr int NOT NULL,
	fk_Darbuotojas NOT NULL,
	PRIMARY KEY(id),
	UNIQUE(fk_Darbuotojastabelio_nr, fk_Darbuotojas),
	FOREIGN KEY(fk_Darbuotojastabelio_nr, fk_Darbuotojas) REFERENCES DB schema.Darbuotojas (tabelio_nr)
);

CREATE TABLE DB schema.Kalinys
(
	kalinio_id int NOT NULL,
	kalejimo_priezastis varchar (255) NOT NULL,
	kalejimo_pradzios_laikotarpis date NOT NULL,
	numatoma_paleidimo_data date NOT NULL,
	fk_KameraKodas varchar NOT NULL,
	fk_Asmuoasmens_kodas int NOT NULL,
	PRIMARY KEY(kalinio_id),
	UNIQUE(fk_Asmuoasmens_kodas),
	CONSTRAINT gyvena FOREIGN KEY(fk_KameraKodas) REFERENCES DB schema.Kameros (Kodas),
	CONSTRAINT kali FOREIGN KEY(fk_Asmuoasmens_kodas) REFERENCES DB schema.Asmuo (asmens_kodas)
);

CREATE TABLE DB schema.Vartai
(
	Kodas varchar NOT NULL,
	Atidaryti boolean NOT NULL,
	Lygis char (0) NOT NULL,
	fk_Blokas varchar NOT NULL,
	fk_Koridorius varchar NOT NULL,
	fk_Kamera varchar NOT NULL,
	fk_Aukstas varchar NOT NULL,
	PRIMARY KEY(Kodas),
	UNIQUE(fk_Kamera),
	UNIQUE(fk_BlokasKodas1),
	UNIQUE(fk_Aukstas),
	CONSTRAINT turi1 FOREIGN KEY(fk_Blokas) REFERENCES DB schema.Blokai (Kodas),
	CONSTRAINT turi4 FOREIGN KEY(fk_Koridorius) REFERENCES DB schema.Koridoriai (Kodas),
	CONSTRAINT turi2 FOREIGN KEY(fk_Kamera) REFERENCES DB schema.Kameros (Kodas),
	FOREIGN KEY(fk_BlokasKodas1) REFERENCES DB schema.Blokai (Kodas),
	FOREIGN KEY(fk_Aukstas) REFERENCES DB schema.Aukstai (Kodas),
	CONSTRAINT turi FOREIGN KEY(fk_AukstasKodas1) REFERENCES DB schema.Aukstai (Kodas)
);

CREATE TABLE DB schema.KortelesVartai
(
	Uzklausa_sekminga boolean NOT NULL,
	Kreipimasis char (0) NOT NULL,
	fk_Vartai varchar NOT NULL,
	fk_Kortele varchar NOT NULL,
	id PRIMARY KEY,
	CONSTRAINT Atidaro1 FOREIGN KEY(fk_Vartai) REFERENCES DB schema.Vartai (Kodas),
	CONSTRAINT atidaro FOREIGN KEY(fk_Kortele) REFERENCES DB schema.Korteles (ID)
);

CREATE TABLE DB schema.Lankytojas
(
	lankytojo_id int NOT NULL,
	lankytojo_telefono_numeris int NOT NULL,
	lankytojo_gyvenamoji_vieta varchar (255) NOT NULL,
	lankymo_data date NOT NULL,
	fk_Kalinyskalinio_id int NOT NULL,
	fk_Asmuoasmens_kodas int NOT NULL,
	PRIMARY KEY(lankytojo_id),
	CONSTRAINT lanko_kalini FOREIGN KEY(fk_Kalinyskalinio_id) REFERENCES DB schema.Kalinys (kalinio_id),
	CONSTRAINT lanko FOREIGN KEY(fk_Asmuoasmens_kodas) REFERENCES DB schema.Asmuo (asmens_kodas)
);

-- typ bazy: POSTGRES

-- gabinet lekarski
CREATE TABLE gabinety (
    id serial PRIMARY KEY,
    nazwa varchar NOT NULL,
    adres varchar NOT NULL,
    kontakt varchar NOT NULL
);

-- pacjenci
CREATE TABLE pacjenci (
    id serial PRIMARY KEY,
    imie varchar NOT NULL,
    nazwisko varchar NOT NULL,
    adres varchar NOT NULL,
    kontakt varchar NOT NULL
);

-- historia choroby
CREATE TABLE choroby (
    id serial PRIMARY KEY,
    gabinet_ID_FK integer REFERENCES gabinety NOT NULL,
    pacjent_ID_FK integer REFERENCES pacjenci ON DELETE CASCADE NOT NULL ,
    nazwa varchar NOT NULL
);

CREATE TABLE choroby_notatki (
    choroba_ID_FK integer REFERENCES choroby ON DELETE CASCADE NOT NULL,
    czas timestamp NOT NULL DEFAULT now(),
    notatka varchar NOT NULL
);

-- scenariusze
CREATE TABLE scenariusze (
    id serial PRIMARY KEY,
    gabinet_ID_FK integer REFERENCES gabinety(id) NOT NULL,
    nazwa varchar NOT NULL
);

-- sesje
-- - odczyty
CREATE TABLE sesje (
    id serial PRIMARY KEY,
    gabinet_ID_FK integer REFERENCES gabinety(id) NOT NULL,
    pacjent_ID_FK integer REFERENCES pacjenci(id) ON DELETE CASCADE NOT NULL ,
    scenariusz_ID_FK integer REFERENCES scenariusze(id) NOT NULL,
    czas_start timestamp,
    czas_koniec timestamp
);

CREATE TABLE sesje_odczyty (
    sesja_ID_FK integer REFERENCES sesje(id) ON DELETE CASCADE NOT NULL,
    czas timestamp NOT NULL DEFAULT now(),

    nazwa varchar NOT NULL,
    wartosc float NOT NULL
);

CREATE TABLE sesje_screenshoty (
    sesja_ID_FK integer REFERENCES sesje(id) ON DELETE CASCADE NOT NULL,
    czas timestamp NOT NULL DEFAULT now(),

    screenshot bytea NOT NULL
);
    
-- TESTOWE ZAPYTANIA

INSERT INTO gabinety (nazwa, adres, kontakt) VALUES('gabinet', 'marszalkowska', '0700');
INSERT INTO pacjenci (imie, nazwisko, adres, kontakt) VALUES('jan', 'kowalski', 'kowalszczyn', '999');
INSERT INTO choroby (gabinet_ID_FK, pacjent_ID_FK, nazwa) VALUES(1, 1, 'choroba');
INSERT INTO choroby_notatki (choroba_ID_FK, notatka) VALUES(1, 'notatki');

INSERT INTO scenariusze (gabinet_ID_FK, nazwa) VALUES(1, 'scenariusz');

-- początek transakcji
INSERT INTO sesje (gabinet_ID_FK, pacjent_ID_FK, scenariusz_ID_FK) VALUES(1, 1, 1);
INSERT INTO sesje_odczyty (sesja_ID_FK, nazwa, wartosc)
    VALUES(1, 'kamera_x', 100);
-- inne parametry
/*
    kamera_x float,
    kamera_y float,
    kamera_z float,
    -- gdzie patrzymy
    kamera_h float,
    kamera_v float,
    -- parametry odczytu
    jakosc_sygnalu float,
    tetno float,
    temperatura float,
    -- fale mozgowe
    delta integer, 
    teta integer, 
    low_alfa integer, 
    high_alfa integer, 
    low_beta integer,
    high_beta integer, 
    mid_gamma integer,
    low_gamma integer,
    --
    skupienie float,
    medytacja float,
*/

-- koniec transakcji
UPDATE sesje SET czas_koniec = now() WHERE id = 1;

-- wczytanie odczytów
SELECT * FROM sesje_odczyty JOIN sesje ON (id = sesja_ID_FK AND czas_koniec IS NOT NULL) WHERE sesja_ID_FK = 1 AND nazwa = 'kamera_x' ORDER BY czas;

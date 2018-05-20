/**
                                                 +--------------------------+
        +-------+                                |Users                     |
        |Records|                                +-------+---------+--------+
        +-------+------------+                   |id (PK)|name (UQ)|password|
        |id (PK)|user_id (FK)|                   +-------+---------+--------+
        +-------+------------+               +-->|1      |admin    |***     |
 +----->|2      |1           |>--------------+   +-------+---------+--------+
 |      +-------+------------+               |
 | +--->|1      |1           |>--------------+
 | |    +-------+------------+
 | |
 | |    +-------------------------------+
 | |    |Properties                     |
 | |    +-------------------------------+
 | |    |record_id (FK)|key   |value    |
 | |    +--------------+------+---------+
 | +---<|1             |nazwa |marchewka|
 | |    +--------------+------+---------+
 | +---<|1             |ilosc |5        |
 |      +--------------+------+---------+
 +-----<|2             |nazwa |cebula   |
 |      +--------------+------+---------+
 +-----<|2             |ilosc |1        |
        +--------------+------+---------+
 
*/

-- Users

CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    name varchar UNIQUE,
    password varchar
);

-- Przykładowe loginy
    INSERT INTO users (name, password)
    SELECT 'admin', '$2y$10$/PQIvCNP/EZ9PtANixwk6e83a3aJmLS1zr2kt7XgldM5sHADPREsa' 
        WHERE NOT EXISTS(SELECT 1 FROM users WHERE name='admin');

    INSERT INTO users (name, password)
    SELECT 'fred', '$2y$10$/PQIvCNP/EZ9PtANixwk6e83a3aJmLS1zr2kt7XgldM5sHADPREsa' 
        WHERE NOT EXISTS(SELECT 1 FROM users WHERE name='fred');

-- Records

CREATE TABLE IF NOT EXISTS records (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    user_id INTEGER NOT NULL,

    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Properties

CREATE TABLE IF NOT EXISTS properties (
    record_id INTEGER,
    key varchar,
    value varchar,

    FOREIGN KEY(record_id) REFERENCES records(id) ON DELETE CASCADE,
    PRIMARY KEY(record_id, key)
);
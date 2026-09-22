-- Jobsheet 8: initial schema of simpus_mini database (PostgreSQL)
-- Run it after creating a database, for example:
--   createdb -U postgres simpus_mini
--   psql -U postgres -d simpus_mini -f sql/01_buku_anggota.sql
CREATE TABLE
    IF NOT EXISTS books (
        id SERIAL PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        author VARCHAR(255) NOT NULL,
        year INTEGER NOT NULL,
        isbn VARCHAR(50),
        stock INTEGER NOT NULL DEFAULT 0,
        category VARCHAR(50)
    );

CREATE TABLE
    IF NOT EXISTS members (
        id SERIAL PRIMARY KEY,
        nama VARCHAR(255) NOT NULL,
        no_anggota VARCHAR(50) NOT NULL UNIQUE,
        alamat VARCHAR(255),
        no_hp VARCHAR(30)
    );
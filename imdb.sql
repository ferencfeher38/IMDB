-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Nov 26. 14:34
-- Kiszolgáló verziója: 10.4.14-MariaDB
-- PHP verzió: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `imdb`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `actor`
--

CREATE TABLE `actor` (
  `actor_name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `year_of_birth` decimal(4,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `actor`
--

INSERT INTO `actor` (`actor_name`, `year_of_birth`) VALUES
('Chris Pratt', '1979'),
('Eddie Murphy', '1961'),
('Frank James Cooper', '1901'),
('Gal Gadot', '1985'),
('Jason Momoa', '1979'),
('John Leguizamo', '1964'),
('Jung-woo Ha', '1978'),
('Kate Winslet', '1975'),
('Leonardo DiCaprio', '1974'),
('Robert Pattinson', '1986'),
('Sam Worthington', '1976'),
('Will Smith', '1968'),
('Woody Harrelson', '1961');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `film`
--

CREATE TABLE `film` (
  `film_name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `studio_name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `director` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `film_date` decimal(4,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `film`
--

INSERT INTO `film` (`film_name`, `studio_name`, `director`, `film_date`) VALUES
('A Muppets Christmas: Letters to Santa', 'The Walt Disney Studios', 'Kirk Thatcher', '2008'),
('Aladdin', 'Walt Disney Pictures', 'Guy Ritchie', '2019'),
('Aquaman', 'Warner Bros', 'James Wan', '2018'),
('Avatar', '20th Century Fox', 'James Cameron', '2009'),
('Cloak and Dagger', 'United States Productions', 'Fritz Lang', '1946'),
('Jégkorszak', '20th Century Fox Animation', 'Chris Wedge', '2002'),
('Jurassic World', 'Universal Studios', 'Colin Trevorrow', '2015'),
('Shrek', 'Universal Studios', 'Andrew Adamson', '2001'),
('Tenet', 'Warner Bros', 'Christopher Nolan', '2020'),
('The Berlin File', 'Sony Pictures Classics', 'Rju Szungvan', '2013'),
('Titanic', 'Paramount Pictures', 'James Cameron', '1998'),
('Tripla kilences', 'Worldview Entertainment', 'John Hillcoat', '2016'),
('Wonder Woman', 'Warner Bros', 'Patty Jenkins', '2017');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `film_studio`
--

CREATE TABLE `film_studio` (
  `studio_name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `country` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `studio_date` decimal(4,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `film_studio`
--

INSERT INTO `film_studio` (`studio_name`, `country`, `studio_date`) VALUES
('20th Century Fox', 'United States', '1935'),
('20th Century Fox Animation', 'United States', '1997'),
('Paramount Pictures', 'United States', '1912'),
('Sony Pictures Classics', 'United States', '1991'),
('The Walt Disney Studios', 'United States', '1923'),
('United Artists Entertainment, LLC', 'United States', '1919'),
('United States Productions', 'United States', '1946'),
('Universal Studios', 'United States', '1912'),
('Walt Disney Pictures', 'United States', '1923'),
('Warner Bros', 'United States', '1918'),
('World Wide Pictures', 'United States', '1951'),
('Worldview Entertainment', 'United States', '2007');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `performance`
--

CREATE TABLE `performance` (
  `film_name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `actor_name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `performance`
--

INSERT INTO `performance` (`film_name`, `actor_name`) VALUES
('Aladdin', 'Will Smith'),
('Aquaman', 'Jason Momoa'),
('Cloak and Dagger', 'Frank James Cooper'),
('Jégkorszak', 'John Leguizamo'),
('Jurassic World', 'Chris Pratt'),
('Shrek', 'Eddie Murphy'),
('Tenet', 'Robert Pattinson'),
('The Berlin File', 'Jung-woo Ha'),
('Titanic', 'Kate Winslet'),
('Titanic', 'Leonardo DiCaprio'),
('Tripla kilences', 'Kate Winslet'),
('Tripla kilences', 'Woody Harrelson'),
('Wonder Woman', 'Gal Gadot');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`actor_name`);

--
-- A tábla indexei `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`film_name`),
  ADD KEY `studio_name` (`studio_name`);

--
-- A tábla indexei `film_studio`
--
ALTER TABLE `film_studio`
  ADD PRIMARY KEY (`studio_name`);

--
-- A tábla indexei `performance`
--
ALTER TABLE `performance`
  ADD PRIMARY KEY (`film_name`,`actor_name`),
  ADD KEY `actor_name` (`actor_name`);

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`studio_name`) REFERENCES `film_studio` (`studio_name`);

--
-- Megkötések a táblához `performance`
--
ALTER TABLE `performance`
  ADD CONSTRAINT `performance_ibfk_1` FOREIGN KEY (`film_name`) REFERENCES `film` (`film_name`),
  ADD CONSTRAINT `performance_ibfk_2` FOREIGN KEY (`actor_name`) REFERENCES `actor` (`actor_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

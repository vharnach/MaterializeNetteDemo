Materialize Nette demo
=================

Tento projekt obsahuje ukázku práce s CSS knihovnou Materialize, Nette frameworkem a MySql.


Požadavky
------------

- PHP 8.2
- MySql databáze
- Web server (Apache)


Databáze
------------

Databáze je složena pouze z jediné tabulky - brand - obsahující značky.

![Databázový design](https://i.ibb.co/ByfzPzh/image.png "Databáze")

```
CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`brand_id`)
);
```

```
INSERT INTO `brand` (`brand_id`, `name`) VALUES
(1, 'Sportisimo'),
(2, 'O2'),
(3, 'Brand Embassy'),
(4, 'Secheron Hasler'),
(5, 'T-Mobile'),
(6, 'Nevím'),
(7, 'Hacking Team'),
(8, 'Fakt nevím'),
(9, 'Kačer donald'),
(10, 'My z Kačerova'),
(11, 'Strýček Skrblík'),
(12, 'Poslední, už mi došly nápady'),
(13, 'Aa2 Brand'),
(66, 'ASD'),
(65, 'AAA Auto'),
(17, 'E Brand'),
(18, 'F Brand'),
(19, 'G Brand'),
(20, 'H Brand'),
(21, 'I Brand'),
(22, 'J Brandd'),
(23, 'K Brand'),
(24, 'L Brand'),
(25, 'M Brand'),
(26, 'N Brand'),
(27, 'O Brand'),
(28, 'P Brand'),
(29, 'Q Brand'),
(30, 'R Brand'),
(31, 'S Brand'),
(32, 'T Brand'),
(33, 'U Brand'),
(34, 'V Brand'),
(35, 'W Brand'),
(36, 'X Brand'),
(37, 'Y Brand'),
(38, 'Z Brand');
```



Instalace
------------

Po pullnutí projektu je potřeba vytvořit databázi a v ní tabulku brand. Poté vložit nějaké sample brandy. Script přiložen.

Dále zkopírovat soubor '/config/local.neon.example' do '/config/local.neon' a upravit tam přístupy do databáze.

Pak stáhnout závislosti z Composeru - 'composer install'
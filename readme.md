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

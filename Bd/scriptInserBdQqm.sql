/*
Scripte d'insertion de données dans la base de données QQM
Création 11/02/2020
Romain Ravault
*/

SET foreign_key_checks = 0;

USE qqm;

-- Ajout de données à la table cooker                                                                                                                                                                                     
TRUNCATE cooker;

INSERT INTO cooker
(pseudo, pwd) 
VALUES
 ("Plue", "123");

-- Ajout de données à la table season
TRUNCATE season;

INSERT INTO season
(season_name)
VALUES
 ("printemps"),
 ("été"),
 ("automne"),
 ("hiver");
 
 -- ajout de données à la table position_in_meal
 
 TRUNCATE position_in_meal;
 
 INSERT INTO position_in_meal
 (position)
 VALUES
  ("entrée"),
  ("plat"),
  ("dessert");
  
  
 -- ajout de données à la table type_of_dish
 
 TRUNCATE type_of_dish;
 
 INSERT INTO type_of_dish
 (type_name)
 VALUES
 ("vegetarien"),
 ("viande"),
 ("poisson"),
 ("vegan"),
 ("sans viande");
 
 -- ajout de données à la table country
 
 TRUNCATE country;
 
 INSERT INTO country
 (country_name)
 VALUES
 ("france"),
 ("japon"),
 ("italie"),
 ("mexique"),
 ("espagne");
 
 -- ajout de données à la table ingredient
 
 TRUNCATE ingredient;
 
 INSERT INTO ingredient
 (ingredient, ingredient_calorie)
 VALUES
 ("carotte", "30"),
 ("pomme", "52"),
 ("pomme de terre", "85"),
 ("riz", "130"),
 ("oeuf", "155");

SET foreign_key_checks = 1;
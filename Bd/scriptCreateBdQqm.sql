/*
Création de la base de donnée QQM
Romain Ravault
07/02/2020
*/

SET foreign_key_checks = 0;

#Création de la base de donnée QQM
DROP DATABASE IF EXISTS qqm;

CREATE DATABASE qqm
DEFAULT CHARACTER SET utf8
COLLATE utf8_general_ci;

USE qqm;

-- Création de la table contenant les utilisateurs (cooker)

DROP TABLE IF EXISTS cooker;

CREATE TABLE cooker (
    id_cooker INT(10) unsigned NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(50) NOT NULL,
    pwd VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_cooker)
);


-- Création de la table contenant les recettes (recipe)

DROP TABLE IF EXISTS recipe;

CREATE TABLE recipe (
    id_recipe INT(10) unsigned NOT NULL AUTO_INCREMENT,
    recipe_title VARCHAR(50) NOT NULL,
    recipe TEXT NOT NULL,
    recipe_visibility INT(1) NOT NULL,
    id_cooker INT(10) unsigned NOT NULL,
    PRIMARY KEY (id_recipe),
        CONSTRAINT recipe_to_cooker
        FOREIGN KEY (id_cooker)
        REFERENCES cooker(id_cooker)
);


-- Création de la table contenant les saisons (season)

DROP TABLE IF EXISTS season;

CREATE TABLE season (
    season_name VARCHAR(8) NOT NULL,
    PRIMARY KEY (season_name)
);

-- Création de la table liens entre recipe et season

DROP TABLE IF EXISTS the_recipe_season;

CREATE TABLE the_recipe_season (
    id_recipe INT(10) unsigned NOT NULL,
	season_name VARCHAR(8) NOT NULL,
    PRIMARY KEY (id_recipe, season_name),
        CONSTRAINT the_recipe_season_to_recipe_to_season
        FOREIGN KEY (id_recipe)
        REFERENCES recipe(id_recipe),
		FOREIGN KEY (season_name)
        REFERENCES season(season_name)
);


-- Création de la table contenant la position du plat dans un repas (position_in_meal)

DROP TABLE IF EXISTS position_in_meal;

CREATE TABLE position_in_meal (
    position VARCHAR(10) NOT NULL,
    id_recipe INT(10) unsigned NOT NULL,
    PRIMARY KEY (position)
);

-- Création de la table liens entre recipe et position_in_meal

DROP TABLE IF EXISTS the_recipe_meal_position;

CREATE TABLE the_recipe_meal_position (
    id_recipe INT(10) unsigned NOT NULL,
	position VARCHAR(10) NOT NULL,
    PRIMARY KEY (id_recipe, position),
        CONSTRAINT the_recipe_to_meal_position
        FOREIGN KEY (id_recipe)
        REFERENCES recipe(id_recipe),
		FOREIGN KEY (position)
        REFERENCES position_in_meal(position)
);


-- Création de la table contenant la type de plat (type_of_dish)

DROP TABLE IF EXISTS type_of_dish;

CREATE TABLE type_of_dish (
    id_type INT(10) NOT NULL AUTO_INCREMENT,
    type_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_type)
);

-- Création de la table liens entre recipe et type_of_dish

DROP TABLE IF EXISTS the_recipe_type;

CREATE TABLE the_recipe_type (
    id_recipe INT(10) unsigned NOT NULL,
	id_type INT(10) NOT NULL,
    PRIMARY KEY (id_recipe, id_type),
        CONSTRAINT the_recipe_to_type_of_dish
        FOREIGN KEY (id_recipe)
        REFERENCES recipe(id_recipe),
		FOREIGN KEY (id_type)
        REFERENCES type_of_dish(id_type)
);


-- Création de la table contenant les pays (country)

DROP TABLE IF EXISTS country;

CREATE TABLE country (
    id_country INT(10) NOT NULL AUTO_INCREMENT,
    country_name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_country)
);

-- Création de la table liens entre recipe et country

DROP TABLE IF EXISTS the_recipe_country;

CREATE TABLE the_recipe_country (
    id_recipe INT(10) unsigned NOT NULL,
	id_country INT(10) NOT NULL,
    PRIMARY KEY (id_recipe, id_country),
        CONSTRAINT the_recipe_to_country
        FOREIGN KEY (id_recipe)
        REFERENCES recipe(id_recipe),
		FOREIGN KEY (id_country)
        REFERENCES country(id_country)
);

-- Création de la table contenant les ingredients (ingredient)

DROP TABLE IF EXISTS ingredient;

CREATE TABLE ingredient (
    id_ingredient INT(10) unsigned NOT NULL AUTO_INCREMENT,
    ingredient VARCHAR(50) NOT NULL,
    ingredient_calorie VARCHAR(50),
    PRIMARY KEY (id_ingredient)
);

-- Création de la table liens entre recipe et ingredient (aRecipe)

DROP TABLE IF EXISTS a_recipe;

CREATE TABLE a_recipe (
    id_recipe INT(10) unsigned NOT NULL,
	id_ingredient INT(10) unsigned NOT NULL,
    PRIMARY KEY (id_recipe, id_ingredient),
        CONSTRAINT aRecipe_to_recipe_to_ingredient
        FOREIGN KEY (id_recipe)
        REFERENCES recipe(id_recipe),
		FOREIGN KEY (id_ingredient)
        REFERENCES ingredient(id_ingredient)
);


 SET foreign_key_checks = 1;
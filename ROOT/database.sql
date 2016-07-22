DROP SCHEMA IF EXISTS `appstore` ;

CREATE SCHEMA IF NOT EXISTS `appstore` DEFAULT CHARACTER SET utf8 ;
USE `appstore` ;

DROP TABLE IF EXISTS `appstore`.`users` ;

CREATE TABLE IF NOT EXISTS `appstore`.`users` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`type` INT UNSIGNED NOT NULL,
`email` VARCHAR(45) NOT NULL,
`password` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`),
UNIQUE INDEX `email_UNIQUE` (`email` ASC))
;

DROP TABLE IF EXISTS `appstore`.`profiles` ;

CREATE TABLE IF NOT EXISTS `appstore`.`profiles` (
`user_id` INT UNSIGNED NOT NULL,
`name` VARCHAR(45) NOT NULL,
`nrc` VARCHAR(45) NOT NULL,
`billing_info` VARCHAR(255) NOT NULL,
`address` VARCHAR(255) NULL,
`balance` INT UNSIGNED NOT NULL,
PRIMARY KEY (`user_id`),
UNIQUE INDEX `nrc_UNIQUE` (`nrc` ASC),
FOREIGN KEY (`user_id`)
REFERENCES `appstore`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`transactions` ;

CREATE TABLE IF NOT EXISTS `appstore`.`transactions` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` INT UNSIGNED NOT NULL,
`completed` INT UNSIGNED NOT NULL,
`date` DATETIME NOT NULL,
`amount` INT UNSIGNED NOT NULL,
`type` INT UNSIGNED NOT NULL,
PRIMARY KEY (`id`),
FOREIGN KEY (`user_id`)
REFERENCES `appstore`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`applications` ;

CREATE TABLE IF NOT EXISTS `appstore`.`applications` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` INT UNSIGNED NOT NULL,
`keyword` VARCHAR(255) NOT NULL,
`rating` FLOAT,
`updated_date` DATETIME NOT NULL,
`icon` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`),
FOREIGN KEY (`user_id`)
REFERENCES `appstore`.`users` (`id`)
ON DELETE NO ACTION
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`purchases` ;

CREATE TABLE IF NOT EXISTS `appstore`.`purchases` (
`user_id` INT UNSIGNED NOT NULL,
`app_id` INT UNSIGNED NOT NULL,
`date` DATETIME NOT NULL,
`price` INT UNSIGNED NOT NULL,
PRIMARY KEY (`app_id`, `user_id`),
FOREIGN KEY (`user_id`)
REFERENCES `appstore`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION,
FOREIGN KEY (`app_id`)
REFERENCES `appstore`.`applications` (`id`)
ON DELETE NO ACTION
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`wishlist` ;

CREATE TABLE IF NOT EXISTS `appstore`.`wishlist` (
`user_id` INT UNSIGNED NOT NULL,
`app_id` INT UNSIGNED NOT NULL,
`date` DATETIME NOT NULL,
PRIMARY KEY (`user_id`, `app_id`),
FOREIGN KEY (`user_id`)
REFERENCES `appstore`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION,
FOREIGN KEY (`app_id`)
REFERENCES `appstore`.`applications` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`transactionreports` ;

CREATE TABLE IF NOT EXISTS `appstore`.`transactionreports` (
`transaction_id` INT UNSIGNED NOT NULL,
`note` VARCHAR(255) NOT NULL,
`date` DATETIME NOT NULL,
PRIMARY KEY (`transaction_id`),
FOREIGN KEY (`transaction_id`)
REFERENCES `appstore`.`transactions` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`inappropirateapps` ;

CREATE TABLE IF NOT EXISTS `appstore`.`inappropirateapps` (
`user_id` INT UNSIGNED NOT NULL,
`app_id` INT UNSIGNED NOT NULL,
`date` DATETIME NOT NULL,
PRIMARY KEY (`user_id`, `app_id`),
FOREIGN KEY (`user_id`)
REFERENCES `appstore`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION,
FOREIGN KEY (`app_id`)
REFERENCES `appstore`.`applications` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`stars` ;

CREATE TABLE IF NOT EXISTS `appstore`.`stars` (
`app_id` INT UNSIGNED NOT NULL,
`user_id` INT UNSIGNED NOT NULL,
`star` INT UNSIGNED NOT NULL,
PRIMARY KEY (`app_id`, `user_id`),
FOREIGN KEY (`user_id`)
REFERENCES `appstore`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION,
FOREIGN KEY (`app_id`)
REFERENCES `appstore`.`applications` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`feedbacks` ;

CREATE TABLE IF NOT EXISTS `appstore`.`feedbacks` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` INT UNSIGNED NOT NULL,
`app_id` INT UNSIGNED NOT NULL,
`content` VARCHAR(255) NOT NULL,
`date` DATETIME NOT NULL,
PRIMARY KEY (`id`),
FOREIGN KEY (`user_id`)
REFERENCES `appstore`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION,
FOREIGN KEY (`app_id`)
REFERENCES `appstore`.`applications` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`replys` ;

CREATE TABLE IF NOT EXISTS `appstore`.`replys` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`feedback_id` INT UNSIGNED NOT NULL,
`user_id` INT UNSIGNED NOT NULL,
`content` VARCHAR(255) NOT NULL,
`date` DATETIME NOT NULL,
PRIMARY KEY (`id`),
FOREIGN KEY (`user_id`)
REFERENCES `appstore`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION,
FOREIGN KEY (`feedback_id`)
REFERENCES `appstore`.`feedbacks` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`platforms` ;

CREATE TABLE IF NOT EXISTS `appstore`.`platforms` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`name` VARCHAR(45) NOT NULL,
PRIMARY KEY (`id`))
;

DROP TABLE IF EXISTS `appstore`.`categories` ;

CREATE TABLE IF NOT EXISTS `appstore`.`categories` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`name` VARCHAR(45) NOT NULL,
PRIMARY KEY (`id`))
;

DROP TABLE IF EXISTS `appstore`.`appplatforms` ;

CREATE TABLE IF NOT EXISTS `appstore`.`appplatforms` (
`platform_id` INT UNSIGNED NOT NULL,
`app_id` INT UNSIGNED NOT NULL,
PRIMARY KEY (`platform_id`, `app_id`),
FOREIGN KEY (`app_id`)
REFERENCES `appstore`.`applications` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION,
FOREIGN KEY (`platform_id`)
REFERENCES `appstore`.`platforms` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`appcategories` ;

CREATE TABLE IF NOT EXISTS `appstore`.`appcategories` (
`category_id` INT UNSIGNED NOT NULL,
`app_id` INT UNSIGNED NOT NULL,
PRIMARY KEY (`category_id`, `app_id`),
FOREIGN KEY (`category_id`)
REFERENCES `appstore`.`categories` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION,
FOREIGN KEY (`app_id`)
REFERENCES `appstore`.`applications` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`screenshots` ;

CREATE TABLE IF NOT EXISTS `appstore`.`screenshots` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`app_id` INT UNSIGNED NOT NULL,
`path` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`),
FOREIGN KEY (`app_id`)
REFERENCES `appstore`.`applications` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`appdetails` ;

CREATE TABLE IF NOT EXISTS `appstore`.`appdetails` (
`app_id` INT UNSIGNED NOT NULL,
`name` VARCHAR(255) NOT NULL,
`version` VARCHAR(45) NOT NULL,
`price` INT NOT NULL,
`size` INT NOT NULL,
`downloads` INT NOT NULL,
`details` LONGTEXT NOT NULL,
`extra` LONGTEXT NOT NULL,
PRIMARY KEY (`app_id`),
FOREIGN KEY (`app_id`)
REFERENCES `appstore`.`applications` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION)
;

DROP TABLE IF EXISTS `appstore`.`notifications` ;

CREATE TABLE IF NOT EXISTS `appstore`.`notifications` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` INT UNSIGNED NOT NULL,
`proirity` INT(11) NOT NULL,
`content` LONGTEXT NOT NULL,
`date` DATETIME NOT NULL,
PRIMARY KEY (`id`),
FOREIGN KEY (`user_id`)
REFERENCES `appstore`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE NO ACTION)
;

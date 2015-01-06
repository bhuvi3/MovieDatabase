-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema movie_db
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema movie_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `movie_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `movie_db` ;

-- -----------------------------------------------------
-- Table `movie_db`.`genre_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movie_db`.`genre_table` (
  `genre_name` VARCHAR(20) NOT NULL,
  `description` VARCHAR(100) NULL,
  `suggested_audience` VARCHAR(30) NULL,
  PRIMARY KEY (`genre_name`),
  UNIQUE INDEX `genre_name_UNIQUE` (`genre_name` ASC));


-- -----------------------------------------------------
-- Table `movie_db`.`movie_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movie_db`.`movie_table` (
  `movie_id` INT NOT NULL,
  `mname` VARCHAR(75) NOT NULL,
  `release_date` YEAR NULL,
  `duration` INT NULL,
  `language` VARCHAR(45) NULL,
  `genre` VARCHAR(45) NULL,
  `rating` FLOAT NULL DEFAULT 0,
  `num_of_ratings` INT NULL DEFAULT 0,
  `num_of_reviews` INT NULL DEFAULT 0,
  UNIQUE INDEX `movie_id_UNIQUE` (`movie_id` ASC),
  INDEX `genre_idx` (`genre` ASC),
  PRIMARY KEY (`movie_id`),
  CONSTRAINT `genre`
    FOREIGN KEY (`genre`)
    REFERENCES `movie_db`.`genre_table` (`genre_name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `movie_db`.`sequence_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movie_db`.`sequence_table` (
  `movie_id` INT NOT NULL,
  `sequel` INT NULL,
  UNIQUE INDEX `movie_id_UNIQUE` (`movie_id` ASC),
  INDEX `sequel_id_idx` (`sequel` ASC),
  PRIMARY KEY (`movie_id`),
  CONSTRAINT `movie_id`
    FOREIGN KEY (`movie_id`)
    REFERENCES `movie_db`.`movie_table` (`movie_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `sequel_id`
    FOREIGN KEY (`sequel`)
    REFERENCES `movie_db`.`movie_table` (`movie_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `movie_db`.`artist_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movie_db`.`artist_table` (
  `artist_id` INT NOT NULL,
  `art_fname` VARCHAR(20) NOT NULL,
  `art_lname` VARCHAR(20) NULL,
  `job_title` VARCHAR(20) NULL,
  `age` INT NULL,
  `origin` VARCHAR(20) NULL,
  PRIMARY KEY (`artist_id`),
  UNIQUE INDEX `artist_id_UNIQUE` (`artist_id` ASC));


-- -----------------------------------------------------
-- Table `movie_db`.`movie_artist_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movie_db`.`movie_artist_table` (
  `movie_id` INT NOT NULL,
  `artist_id` INT NOT NULL,
  INDEX `artist_id_idx` (`artist_id` ASC),
  INDEX `movie_id_idx` (`movie_id` ASC),
  PRIMARY KEY (`movie_id`, `artist_id`),
  CONSTRAINT `movie_id1`
    FOREIGN KEY (`movie_id`)
    REFERENCES `movie_db`.`movie_table` (`movie_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `artist_id1`
    FOREIGN KEY (`artist_id`)
    REFERENCES `movie_db`.`artist_table` (`artist_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `movie_db`.`award_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movie_db`.`award_table` (
  `award_id` INT NOT NULL,
  `award_name` VARCHAR(30) NULL,
  `description` VARCHAR(100) NULL,
  `organisation` VARCHAR(25) NULL,
  PRIMARY KEY (`award_id`),
  UNIQUE INDEX `award_id_UNIQUE` (`award_id` ASC));


-- -----------------------------------------------------
-- Table `movie_db`.`movie_artist_award_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movie_db`.`movie_artist_award_table` (
  `award_id` INT NOT NULL,
  `artist_id` INT NOT NULL,
  `movie_id` INT NOT NULL,
  `category` VARCHAR(25) NULL,
  `year` YEAR NULL,
  INDEX `award_id_idx` (`award_id` ASC),
  INDEX `artist_id_idx` (`artist_id` ASC),
  INDEX `movie_id_idx` (`movie_id` ASC),
  PRIMARY KEY (`award_id`, `artist_id`, `movie_id`),
  CONSTRAINT `award_id`
    FOREIGN KEY (`award_id`)
    REFERENCES `movie_db`.`award_table` (`award_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `artist_id`
    FOREIGN KEY (`artist_id`)
    REFERENCES `movie_db`.`artist_table` (`artist_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `movie_id2`
    FOREIGN KEY (`movie_id`)
    REFERENCES `movie_db`.`movie_table` (`movie_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `movie_db`.`user_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movie_db`.`user_table` (
  `username` VARCHAR(25) NOT NULL,
  `password` VARCHAR(20) NOT NULL,
  `d_admin_client` INT NULL,
  PRIMARY KEY (`username`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC));


-- -----------------------------------------------------
-- Table `movie_db`.`review_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movie_db`.`review_table` (
  `user_name` VARCHAR(25) NOT NULL,
  `movie_id` INT NOT NULL,
  `review` VARCHAR(255) NULL,
  INDEX `username_idx` (`user_name` ASC),
  INDEX `movie_id_idx` (`movie_id` ASC),
  PRIMARY KEY (`user_name`, `movie_id`),
  CONSTRAINT `username2`
    FOREIGN KEY (`user_name`)
    REFERENCES `movie_db`.`user_table` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `movie_id3`
    FOREIGN KEY (`movie_id`)
    REFERENCES `movie_db`.`movie_table` (`movie_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `movie_db`.`watchlist`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movie_db`.`watchlist` (
  `user_name` VARCHAR(25) NOT NULL,
  `movie_id` INT NOT NULL,
  INDEX `username_idx` (`user_name` ASC),
  INDEX `movie_id_idx` (`movie_id` ASC),
  PRIMARY KEY (`user_name`, `movie_id`),
  CONSTRAINT `username0`
    FOREIGN KEY (`user_name`)
    REFERENCES `movie_db`.`user_table` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `movie_id0`
    FOREIGN KEY (`movie_id`)
    REFERENCES `movie_db`.`movie_table` (`movie_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `movie_db`.`rating_table`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `movie_db`.`rating_table` (
  `user_name` VARCHAR(25) NOT NULL,
  `movie_id` INT NOT NULL,
  `rating` FLOAT NULL DEFAULT 0,
  INDEX `username_idx` (`user_name` ASC),
  INDEX `movie_id_idx` (`movie_id` ASC),
  PRIMARY KEY (`user_name`, `movie_id`),
  CONSTRAINT `username1`
    FOREIGN KEY (`user_name`)
    REFERENCES `movie_db`.`user_table` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `movie_id4`
    FOREIGN KEY (`movie_id`)
    REFERENCES `movie_db`.`movie_table` (`movie_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

USE `movie_db` ;

-- -----------------------------------------------------
-- procedure RATING_INSERT
-- -----------------------------------------------------

DELIMITER $$
USE `movie_db`$$
CREATE PROCEDURE `RATING_INSERT` (IN u_name varchar(25), IN m_id INT, IN rat FLOAT)
BEGIN

	DECLARE nos_r INT DEFAULT 0;
	DECLARE num_rat INT DEFAULT 0;
	DECLARE new_rat INT DEFAULT 0;
	DECLARE tot_rat INT DEFAULT 0;
	
	select num_of_ratings into nos_r from movie_db.movie_table 
	where movie_id=m_id;
	
	insert into movie_db.rating_table (user_name, movie_id, rating) values (u_name, m_id, rat);
	-- if above query fails it exits here
	
	update movie_db.movie_table
	set num_of_ratings=nos_r + 1
	where movie_id=m_id;
	
	select sum(rating) into tot_rat from movie_db.rating_table
	group by movie_id
	having movie_id=m_id;
	
	select num_of_ratings into num_rat from movie_db.movie_table
	where movie_id=m_id;
	
	-- set new_rat = ((old_rat * nos_r) + rat)/(nos_r + 1);
	
	-- set new_rat = tot_rat / num_rat;
	
	update movie_db.movie_table
	set rating = tot_rat / num_rat
	where movie_id=m_id;
 
END$$

DELIMITER ;
USE `movie_db`;

DELIMITER $$
USE `movie_db`$$
CREATE DEFINER = CURRENT_USER TRIGGER `movie_db`.`review_table_AFTER_INSERT` AFTER INSERT ON `review_table` FOR EACH ROW
begin
	update movie_db.movie_table
	set num_of_reviews = num_of_reviews + 1
    where movie_id = NEW.movie_id;
end$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `movie_db`.`genre_table`
-- -----------------------------------------------------
START TRANSACTION;
USE `movie_db`;
INSERT INTO `movie_db`.`genre_table` (`genre_name`, `description`, `suggested_audience`) VALUES ('Crime', 'action of a criminal mastermind', '15+');
INSERT INTO `movie_db`.`genre_table` (`genre_name`, `description`, `suggested_audience`) VALUES ('Action', 'physical stunts and chases, possibly with rescues, battles, fights', '10+');
INSERT INTO `movie_db`.`genre_table` (`genre_name`, `description`, `suggested_audience`) VALUES ('Western', 'based on western USA', '16+');
INSERT INTO `movie_db`.`genre_table` (`genre_name`, `description`, `suggested_audience`) VALUES ('Drama', 'relies on the emotional and relational development', '18+');
INSERT INTO `movie_db`.`genre_table` (`genre_name`, `description`, `suggested_audience`) VALUES ('Adventure', ' exciting undertaking involving risk and physical danger', '12+');
INSERT INTO `movie_db`.`genre_table` (`genre_name`, `description`, `suggested_audience`) VALUES ('Comedy', 'makes people laugh', '5+');

COMMIT;


-- -----------------------------------------------------
-- Data for table `movie_db`.`movie_table`
-- -----------------------------------------------------
START TRANSACTION;
USE `movie_db`;
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (1, 'The Shawshank Redemption', 1994, 142, 'English', 'Crime', 4, 1, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (2, 'The Godfather', 1972, 175, 'English', 'Crime', 3.5, 1, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (3, '3 Idiots', 2009, 170, 'Hindi', 'Comedy', 0, 0, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (4, 'Harry Potter 1', 2001, 152, 'English', 'Adventure', 2, 1, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (5, 'Harry Potter 2', 2002, 161, 'English', 'Adventure', 0, 0, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (6, 'Harry Potter 3', 2004, 142, 'English', 'Adventure', 0, 0, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (7, 'Harry Potter 4', 2005, 157, 'English', 'Adventure', 0, 0, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (8, 'Harry Potter 5', 2007, 138, 'English', 'Adventure', 0, 0, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (9, 'Harry Potter 6', 2009, 152, 'English', 'Adventure', 0, 0, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (10, 'Harry Potter 7.1', 2010, 146, 'English', 'Adventure', 0, 0, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (11, 'Harry Potter 7.2', 2011, 130, 'English', 'Adventure', 3.5, 2, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (12, 'Seven', 1995, 127, 'English', 'Drama', 0, 0, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (13, 'Gravity', 2013, 91, 'English', 'Adventure', 0, 0, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (14, 'Interstellar', 2014, 169, 'English', 'Adventure', 0, 0, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (15, 'Les Miserables', 2012, 158, 'English', 'Drama', 4, 1, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (16, 'The Prestige', 2006, 140, 'English', 'Action', 3, 1, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (17, 'Dark Knight', 2008, 152, 'English', 'Action', 4.67, 3, 0);
INSERT INTO `movie_db`.`movie_table` (`movie_id`, `mname`, `release_date`, `duration`, `language`, `genre`, `rating`, `num_of_ratings`, `num_of_reviews`) VALUES (18, 'Dark Knight Rises', 2012, 165, 'English', 'Action', 3.9, 1, 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `movie_db`.`sequence_table`
-- -----------------------------------------------------
START TRANSACTION;
USE `movie_db`;
INSERT INTO `movie_db`.`sequence_table` (`movie_id`, `sequel`) VALUES (4, 5);
INSERT INTO `movie_db`.`sequence_table` (`movie_id`, `sequel`) VALUES (5, 6);
INSERT INTO `movie_db`.`sequence_table` (`movie_id`, `sequel`) VALUES (6, 7);
INSERT INTO `movie_db`.`sequence_table` (`movie_id`, `sequel`) VALUES (7, 8);
INSERT INTO `movie_db`.`sequence_table` (`movie_id`, `sequel`) VALUES (8, 9);
INSERT INTO `movie_db`.`sequence_table` (`movie_id`, `sequel`) VALUES (9, 10);
INSERT INTO `movie_db`.`sequence_table` (`movie_id`, `sequel`) VALUES (10, 11);
INSERT INTO `movie_db`.`sequence_table` (`movie_id`, `sequel`) VALUES (17, 18);

COMMIT;


-- -----------------------------------------------------
-- Data for table `movie_db`.`artist_table`
-- -----------------------------------------------------
START TRANSACTION;
USE `movie_db`;
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (1, 'Christopher', 'Nolan', 'Director', 35, 'England');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (2, 'Christian', 'Bale', 'Actor', 28, 'USA');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (3, 'Anne ', 'Hathaway', 'Actor', 26, 'England');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (4, 'Morgan', 'Freeman', 'Actor', 50, 'USA');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (5, 'Heath', 'Ledger', 'Actor', 35, 'USA');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (6, 'Emma', 'Watson', 'Actor', 20, 'England');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (7, 'Daniel', 'Radcliffe', 'Actor', 20, 'USA');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (8, 'Chris', 'Columbus', 'Director', 55, 'USA');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (9, 'Hugh', 'Jackman', 'Actor', 32, 'USA');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (10, 'Ellen', 'Burstyn', 'Actor', 27, 'USA');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (11, 'Matthew', 'McConaughey', 'Actor', 31, 'England');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (12, 'Francis', 'Coppola', 'Director', 57, 'USA');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (13, 'Al', 'Pacino', 'Actor', 40, 'USA');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (14, 'James', 'Caan', 'Actor', 35, 'England');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (15, 'Frank', 'Darabont', 'Director', 57, 'England');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (16, 'Rajkumar', 'Hirani', 'Director', 40, 'India');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (17, 'Aamir', 'Khan', 'Actor', 30, 'India');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (18, 'Kareena', 'Kapoor', 'Actor', 27, 'India');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (19, 'David', 'Fincher', 'Director', 52, 'USA');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (20, 'Brad', 'Pitt', 'Actor', 34, 'USA');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (21, 'Kevin', 'Spacey', 'Actor', 57, 'USA');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (22, 'Alfonso', 'Cuarón', 'Director', 45, 'Mexico');
INSERT INTO `movie_db`.`artist_table` (`artist_id`, `art_fname`, `art_lname`, `job_title`, `age`, `origin`) VALUES (23, 'Tom', 'Hooper', 'Director', 56, 'USA');

COMMIT;


-- -----------------------------------------------------
-- Data for table `movie_db`.`movie_artist_table`
-- -----------------------------------------------------
START TRANSACTION;
USE `movie_db`;
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (4, 6);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (4, 7);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (4, 8);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (5, 6);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (5, 7);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (5, 8);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (6, 6);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (6, 7);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (6, 8);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (7, 6);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (7, 7);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (7, 8);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (8, 6);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (8, 7);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (8, 8);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (9, 6);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (9, 7);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (9, 8);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (10, 6);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (10, 7);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (10, 8);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (11, 6);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (11, 7);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (11, 8);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (1, 15);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (1, 4);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (2, 13);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (2, 14);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (2, 12);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (3, 16);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (3, 17);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (3, 18);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (12, 19);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (12, 20);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (12, 4);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (13, 22);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (13, 3);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (14, 1);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (14, 3);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (14, 11);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (15, 9);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (16, 9);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (16, 1);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (16, 2);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (15, 3);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (15, 23);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (17, 1);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (17, 2);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (18, 1);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (18, 2);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (18, 3);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (17, 4);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (18, 4);
INSERT INTO `movie_db`.`movie_artist_table` (`movie_id`, `artist_id`) VALUES (17, 5);

COMMIT;


-- -----------------------------------------------------
-- Data for table `movie_db`.`award_table`
-- -----------------------------------------------------
START TRANSACTION;
USE `movie_db`;
INSERT INTO `movie_db`.`award_table` (`award_id`, `award_name`, `description`, `organisation`) VALUES (1, 'Oscar', 'Best', 'USA');
INSERT INTO `movie_db`.`award_table` (`award_id`, `award_name`, `description`, `organisation`) VALUES (2, 'Golden Globe', '2nd Best', 'Britain');

COMMIT;


-- -----------------------------------------------------
-- Data for table `movie_db`.`movie_artist_award_table`
-- -----------------------------------------------------
START TRANSACTION;
USE `movie_db`;
INSERT INTO `movie_db`.`movie_artist_award_table` (`award_id`, `artist_id`, `movie_id`, `category`, `year`) VALUES (1, 3, 15, 'actor', 2012);
INSERT INTO `movie_db`.`movie_artist_award_table` (`award_id`, `artist_id`, `movie_id`, `category`, `year`) VALUES (2, 3, 13, 'supporting', 2013);
INSERT INTO `movie_db`.`movie_artist_award_table` (`award_id`, `artist_id`, `movie_id`, `category`, `year`) VALUES (1, 1, 17, 'director', 2008);
INSERT INTO `movie_db`.`movie_artist_award_table` (`award_id`, `artist_id`, `movie_id`, `category`, `year`) VALUES (1, 1, 16, 'director', 2006);
INSERT INTO `movie_db`.`movie_artist_award_table` (`award_id`, `artist_id`, `movie_id`, `category`, `year`) VALUES (1, 1, 18, 'director', 2012);
INSERT INTO `movie_db`.`movie_artist_award_table` (`award_id`, `artist_id`, `movie_id`, `category`, `year`) VALUES (2, 1, 17, 'director', 2008);
INSERT INTO `movie_db`.`movie_artist_award_table` (`award_id`, `artist_id`, `movie_id`, `category`, `year`) VALUES (1, 4, 12, 'supporting', 1995);
INSERT INTO `movie_db`.`movie_artist_award_table` (`award_id`, `artist_id`, `movie_id`, `category`, `year`) VALUES (1, 4, 1, 'supoorting', 1994);
INSERT INTO `movie_db`.`movie_artist_award_table` (`award_id`, `artist_id`, `movie_id`, `category`, `year`) VALUES (2, 4, 1, 'actor', 1994);
INSERT INTO `movie_db`.`movie_artist_award_table` (`award_id`, `artist_id`, `movie_id`, `category`, `year`) VALUES (2, 2, 17, 'actor', 2008);
INSERT INTO `movie_db`.`movie_artist_award_table` (`award_id`, `artist_id`, `movie_id`, `category`, `year`) VALUES (2, 2, 16, 'actor', 2006);

COMMIT;


-- -----------------------------------------------------
-- Data for table `movie_db`.`user_table`
-- -----------------------------------------------------
START TRANSACTION;
USE `movie_db`;
INSERT INTO `movie_db`.`user_table` (`username`, `password`, `d_admin_client`) VALUES ('admin', 'admin123', 1);
INSERT INTO `movie_db`.`user_table` (`username`, `password`, `d_admin_client`) VALUES ('2', '2', 0);
INSERT INTO `movie_db`.`user_table` (`username`, `password`, `d_admin_client`) VALUES ('3', '3', 0);
INSERT INTO `movie_db`.`user_table` (`username`, `password`, `d_admin_client`) VALUES ('4', '4', 0);
INSERT INTO `movie_db`.`user_table` (`username`, `password`, `d_admin_client`) VALUES ('5', '5', 0);
INSERT INTO `movie_db`.`user_table` (`username`, `password`, `d_admin_client`) VALUES ('6', '6', 0);
INSERT INTO `movie_db`.`user_table` (`username`, `password`, `d_admin_client`) VALUES ('7', '7', 0);
INSERT INTO `movie_db`.`user_table` (`username`, `password`, `d_admin_client`) VALUES ('1', '1', 0);
INSERT INTO `movie_db`.`user_table` (`username`, `password`, `d_admin_client`) VALUES ('8', '8', 0);

COMMIT;


-- -----------------------------------------------------
-- Data for table `movie_db`.`review_table`
-- -----------------------------------------------------
START TRANSACTION;
USE `movie_db`;
INSERT INTO `movie_db`.`review_table` (`user_name`, `movie_id`, `review`) VALUES ('7', 1, 'Very Good movie');
INSERT INTO `movie_db`.`review_table` (`user_name`, `movie_id`, `review`) VALUES ('4', 4, 'Boring!!');
INSERT INTO `movie_db`.`review_table` (`user_name`, `movie_id`, `review`) VALUES ('3', 17, 'Best Movie EVER!!!');
INSERT INTO `movie_db`.`review_table` (`user_name`, `movie_id`, `review`) VALUES ('4', 2, 'Excellent Movie');
INSERT INTO `movie_db`.`review_table` (`user_name`, `movie_id`, `review`) VALUES ('1', 16, 'Could be better..');
INSERT INTO `movie_db`.`review_table` (`user_name`, `movie_id`, `review`) VALUES ('2', 11, 'My Favorite!');
INSERT INTO `movie_db`.`review_table` (`user_name`, `movie_id`, `review`) VALUES ('5', 5, 'Prequel was better :P');
INSERT INTO `movie_db`.`review_table` (`user_name`, `movie_id`, `review`) VALUES ('7', 17, 'Joker Dies! :\'(');
INSERT INTO `movie_db`.`review_table` (`user_name`, `movie_id`, `review`) VALUES ('4', 1, 'Morgan Freeman is THE BEST!');
INSERT INTO `movie_db`.`review_table` (`user_name`, `movie_id`, `review`) VALUES ('8', 15, 'Bale my man!');

COMMIT;


-- -----------------------------------------------------
-- Data for table `movie_db`.`watchlist`
-- -----------------------------------------------------
START TRANSACTION;
USE `movie_db`;
INSERT INTO `movie_db`.`watchlist` (`user_name`, `movie_id`) VALUES ('1', 9);
INSERT INTO `movie_db`.`watchlist` (`user_name`, `movie_id`) VALUES ('1', 10);
INSERT INTO `movie_db`.`watchlist` (`user_name`, `movie_id`) VALUES ('1', 11);
INSERT INTO `movie_db`.`watchlist` (`user_name`, `movie_id`) VALUES ('3', 18);
INSERT INTO `movie_db`.`watchlist` (`user_name`, `movie_id`) VALUES ('2', 15);
INSERT INTO `movie_db`.`watchlist` (`user_name`, `movie_id`) VALUES ('2', 16);

COMMIT;


-- -----------------------------------------------------
-- Data for table `movie_db`.`rating_table`
-- -----------------------------------------------------
START TRANSACTION;
USE `movie_db`;
INSERT INTO `movie_db`.`rating_table` (`user_name`, `movie_id`, `rating`) VALUES ('4', 1, 4.0);
INSERT INTO `movie_db`.`rating_table` (`user_name`, `movie_id`, `rating`) VALUES ('4', 2, 3.7);
INSERT INTO `movie_db`.`rating_table` (`user_name`, `movie_id`, `rating`) VALUES ('4', 4, 2.0);
INSERT INTO `movie_db`.`rating_table` (`user_name`, `movie_id`, `rating`) VALUES ('1', 16, 3.0);
INSERT INTO `movie_db`.`rating_table` (`user_name`, `movie_id`, `rating`) VALUES ('1', 17, 4.0);
INSERT INTO `movie_db`.`rating_table` (`user_name`, `movie_id`, `rating`) VALUES ('2', 11, 5.0);
INSERT INTO `movie_db`.`rating_table` (`user_name`, `movie_id`, `rating`) VALUES ('3', 17, 5.0);
INSERT INTO `movie_db`.`rating_table` (`user_name`, `movie_id`, `rating`) VALUES ('7', 17, 5.0);
INSERT INTO `movie_db`.`rating_table` (`user_name`, `movie_id`, `rating`) VALUES ('3', 11, 2.0);
INSERT INTO `movie_db`.`rating_table` (`user_name`, `movie_id`, `rating`) VALUES ('8', 15, 4.0);
INSERT INTO `movie_db`.`rating_table` (`user_name`, `movie_id`, `rating`) VALUES ('1', 18, 3.9);

COMMIT;


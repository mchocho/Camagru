CREATE DATABASE IF NOT EXISTS camagru;

USE camagru;

CREATE TABLE IF NOT EXISTS `camagru`.`users` (
  `id`             INT UNSIGNED                           NOT NULL AUTO_INCREMENT ,
  `email`          VARCHAR(80)                            NOT NULL ,
  `username`       VARCHAR(20)                            NOT NULL , 
  `password`       VARCHAR(160)                           NOT NULL , 
  `profile_image`  VARCHAR(80)                            NOT NULL DEFAULT 'mojo.jpg', 
  `notifications`  ENUM('T','F')                          NOT NULL DEFAULT 'T',  
  `validated`      ENUM('T','F')                          NOT NULL DEFAULT 'F' , 
  `admin`          ENUM('T','F')                          NOT NULL DEFAULT 'F' , 
  `last_modified`  TIMESTAMP on update CURRENT_TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  `date_created`   TIMESTAMP                              NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`), 
  UNIQUE (`email`), 
  UNIQUE (`username`)
) ENGINE = InnoDB; 

CREATE TABLE IF NOT EXISTS `camagru`.`tokens` (
  `id`             INT UNSIGNED                          NOT NULL AUTO_INCREMENT , 
  `user_id`        INT                                   NOT NULL , 
  `token`          VARCHAR(120)                          NOT NULL , 
  `request`        ENUM('registration',
                        'password_reset', 
                        'email_reset'
                   )                                     NOT NULL , 
  `date_created`  TIMESTAMP                              NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  PRIMARY KEY (`id`), 
  UNIQUE (`token`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `camagru`.`images` ( 
  `id`            INT UNSIGNED                           NOT NULL AUTO_INCREMENT , 
  `user_id`       INT                                    NOT NULL , 
  `name`          VARCHAR(120)                           NOT NULL , 
  `date_created`  TIMESTAMP                              NOT NULL DEFAULT CURRENT_TIMESTAMP , 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `camagru`.`likes` (
  `id`            INT UNSIGNED                           NOT NULL AUTO_INCREMENT ,
  `user_id`       INT UNSIGNED                           NOT NULL ,
  `image_id`      INT UNSIGNED                           NOT NULL ,
  `date_created`  TIMESTAMP                              NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `camagru`.`comment` ( 
  `id`           INT UNSIGNED                            NOT NULL AUTO_INCREMENT , 
  `user_id`      INT UNSIGNED                            NOT NULL , 
  `image_id`     INT UNSIGNED                            NOT NULL , 
  `message`      VARCHAR(800)                            NOT NULL , 
  `date_created` TIMESTAMP                               NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;
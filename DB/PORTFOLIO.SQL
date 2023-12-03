DROP DATABASE IF EXISTS PORTFOLIO;

CREATE DATABASE IF NOT EXISTS PORTFOLIO;
USE PORTFOLIO;
# -----------------------------------------------------------------------------
#       TABLE : USER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS USER
 (
   ID_USER INTEGER(2) NOT NULL AUTO_INCREMENT ,
   ID_LANGUAGE CHAR(2) NOT NULL  ,
   USERNAME VARCHAR(128) NULL  ,
   PASSWORD VARCHAR(255) NULL  
   , PRIMARY KEY (ID_USER) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE USER
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_USER_LANGUAGE
     ON USER (ID_LANGUAGE ASC);

# -----------------------------------------------------------------------------
#       TABLE : FLAG
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FLAG
 (
   ID_FLAG INTEGER(10) NOT NULL AUTO_INCREMENT ,
   ID_LANGUAGE CHAR(2) NOT NULL  ,
   CODE_BASE64 LONGBLOB NULL  
   , PRIMARY KEY (ID_FLAG) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE FLAG
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_FLAG_LANGUAGE
     ON FLAG (ID_LANGUAGE ASC);

# -----------------------------------------------------------------------------
#       TABLE : LANGUAGE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS LANGUAGE
 (
   ID_LANGUAGE CHAR(2) NOT NULL  ,
   NAME VARCHAR(128) NOT NULL  ,
   STATUS SMALLINT(1) NOT NULL  
      DEFAULT 1
   , PRIMARY KEY (ID_LANGUAGE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PROJECT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PROJECT
 (
   ID_PROJECT INTEGER(2) NOT NULL AUTO_INCREMENT ,
   ID_USER_MODIFICATION INTEGER(2) NOT NULL  ,
   ID_USER_CREATION INTEGER(2) NOT NULL  ,
   ID_CATEGORY INTEGER(2) NOT NULL  ,
   TITLE VARCHAR(128) NULL  ,
   TEXT TEXT NULL  ,
   DATE_CREATION DATETIME NULL  
      DEFAULT NOW(),
   DATE_MODIFICATION DATETIME NULL  ,
   STATUS SMALLINT(1) NULL  
      DEFAULT 1
   , PRIMARY KEY (ID_PROJECT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE PROJECT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_PROJECT_USER
     ON PROJECT (ID_USER_MODIFICATION ASC);

CREATE  INDEX I_FK_PROJECT_USER2
     ON PROJECT (ID_USER_CREATION ASC);

CREATE  INDEX I_FK_PROJECT_CATEGORY
     ON PROJECT (ID_CATEGORY ASC);

# -----------------------------------------------------------------------------
#       TABLE : CATEGORY
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CATEGORY
 (
   ID_CATEGORY INTEGER(2) NOT NULL AUTO_INCREMENT ,
   NAME CHAR(32) NOT NULL  ,
   STATUS SMALLINT(1) NULL  
      DEFAULT 1
   , PRIMARY KEY (ID_CATEGORY) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : PROJECTLANGUAGE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PROJECTLANGUAGE
 (
   ID_LANGUAGE CHAR(2) NOT NULL  ,
   ID_PROJECT INTEGER(2) NOT NULL  
   , PRIMARY KEY (ID_LANGUAGE,ID_PROJECT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE PROJECTLANGUAGE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_PROJECTLANGUAGE_LANGUAGE
     ON PROJECTLANGUAGE (ID_LANGUAGE ASC);

CREATE  INDEX I_FK_PROJECTLANGUAGE_PROJECT
     ON PROJECTLANGUAGE (ID_PROJECT ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE USER 
  ADD FOREIGN KEY FK_USER_LANGUAGE (ID_LANGUAGE)
      REFERENCES LANGUAGE (ID_LANGUAGE) ;


ALTER TABLE FLAG 
  ADD FOREIGN KEY FK_FLAG_LANGUAGE (ID_LANGUAGE)
      REFERENCES LANGUAGE (ID_LANGUAGE) ;


ALTER TABLE PROJECT 
  ADD FOREIGN KEY FK_PROJECT_USER (ID_USER_MODIFICATION)
      REFERENCES USER (ID_USER) ;


ALTER TABLE PROJECT 
  ADD FOREIGN KEY FK_PROJECT_USER2 (ID_USER_CREATION)
      REFERENCES USER (ID_USER) ;


ALTER TABLE PROJECT 
  ADD FOREIGN KEY FK_PROJECT_CATEGORY (ID_CATEGORY)
      REFERENCES CATEGORY (ID_CATEGORY) ;


ALTER TABLE PROJECTLANGUAGE 
  ADD FOREIGN KEY FK_PROJECTLANGUAGE_LANGUAGE (ID_LANGUAGE)
      REFERENCES LANGUAGE (ID_LANGUAGE) ;


ALTER TABLE PROJECTLANGUAGE 
  ADD FOREIGN KEY FK_PROJECTLANGUAGE_PROJECT (ID_PROJECT)
      REFERENCES PROJECT (ID_PROJECT) ;


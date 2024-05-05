####################create table user####################
CREATE TABLE USER(
	id char(36) default (UUID()),
    user_name nvarchar(120) NOT NULL,
    avatar varchar(255) NOT NULL,
    email varchar(50) NOT NULL,
    password varchar(150) NOT NULL,
    uid varchar(150)
);

ALTER TABLE USER ADD PRIMARY KEY(`ID`);
####################

####################create table author####################
CREATE TABLE AUTHOR(
	ID CHAR(36) DEFAULT(UUID()),
    NAME VARCHAR(180),
    INFO TEXT
);

ALTER TABLE AUTHOR ADD PRIMARY KEY(`ID`);
####################create table author####################


####################create table comic####################

CREATE TABLE COMIC(
	ID CHAR(36) DEFAULT(UUID()),
    TITLE VARCHAR(255) NOT NULL,
    SUB_TITLE VARCHAR(255) NOT NULL,
    THUMBNAIL VARCHAR(255) NOT NULL,
    SYNOPSIS VARCHAR(255) NOT NULL,
    COUNTRY VARCHAR(120) NOT NULL,
    AUTHOR CHAR(36) NOT NULL,
    PUPLISH_BY CHAR(36) NOT NULL
);

ALTER TABLE COMIC ADD PRIMARY KEY(`ID`);
ALTER TABLE COMIC ADD CONSTRAINT FK_AUTHOR FOREIGN KEY(AUTHOR) REFERENCES AUTHOR(ID);
ALTER TABLE COMIC ADD CONSTRAINT FK_PUPLISH FOREIGN KEY(PUPLISH_BY) REFERENCES USER(ID);

####################create table comic####################


####################create table category####################

CREATE TABLE CATEGORY (
	ID CHAR(36) DEFAULT(UUID()),
    TITLE VARCHAR(255) NOT NULL,
    DISPLAY_COLOR VARCHAR(20) NOT NULL
);

ALTER TABLE CATEGORY ADD PRIMARY KEY(ID);

####################create table category####################


####################create table comic_category####################

CREATE TABLE COMIC_CATEGORY(
	ID_CATEGORY CHAR(36),
    ID_COMIC CHAR(36),
    TITLE_CATEGORY VARCHAR(255) NOT NULL
);

ALTER TABLE COMIC_CATEGORY ADD PRIMARY KEY(ID_CATEGORY, ID_COMIC);

ALTER TABLE COMIC_CATEGORY ADD CONSTRAINT FK_CATEGORY FOREIGN KEY(ID_CATEGORY) REFERENCES CATEGORY(ID);
ALTER TABLE COMIC_CATEGORY ADD CONSTRAINT FK_COMIC FOREIGN KEY(ID_COMIC) REFERENCES COMIC(ID);

DROP TABLE COMIC_CATEGORY;

####################create table comic_category####################


####################create table chapter####################

CREATE TABLE CHAPTER (
	ID CHAR(36) DEFAULT (UUID()),
    TITLE VARCHAR(255) NOT NULL,
    CHAPTER_INDEX INT NOT NULL,
    CONTENT TEXT NOT NULL,
    ID_COMIC CHAR(36) 
);

ALTER TABLE CHAPTER ADD PRIMARY KEY(ID);
ALTER TABLE CHAPTER ADD CONSTRAINT FK_COMIC_CHAPTER FOREIGN KEY(ID_COMIC) REFERENCES COMIC(ID);

####################create table chapter####################


####################create table search####################

CREATE TABLE SEARCH(
	ID CHAR(36) DEFAULT(UUID()),
    KEYWORD VARCHAR(255) NOT NULL,
    ID_COMIC CHAR(36)
);

ALTER TABLE SEARCH ADD PRIMARY KEY(ID);
ALTER TABLE SEARCH ADD CONSTRAINT FK_COMIC_SEARCH FOREIGN KEY(ID_COMIC) REFERENCES COMIC(ID);

####################create table search####################


####################create table view####################

CREATE TABLE VIEW(
	ID_COMIC CHAR(36),
    ID_USER CHAR(36)
);

ALTER TABLE VIEW ADD PRIMARY KEY(ID_COMIC, ID_USER);
ALTER TABLE VIEW ADD CONSTRAINT FK_COMIC_VIEW FOREIGN KEY(ID_COMIC) REFERENCES COMIC (ID);
ALTER TABLE VIEW ADD CONSTRAINT FK_USER_VIEW FOREIGN KEY(ID_USER) REFERENCES USER (ID);

####################create table view####################


####################create table favorite####################

CREATE TABLE FAVORITE(
	ID_COMIC CHAR(36),
    ID_USER CHAR(36)
);

ALTER TABLE FAVORITE ADD PRIMARY KEY(ID_COMIC, ID_USER);
ALTER TABLE FAVORITE ADD CONSTRAINT FK_COMIC_FAVORITE FOREIGN KEY(ID_COMIC) REFERENCES COMIC (ID);
ALTER TABLE FAVORITE ADD CONSTRAINT FK_USER_FAVORITE FOREIGN KEY(ID_USER) REFERENCES USER (ID);

####################create table favorite####################
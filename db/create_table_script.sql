CREATE DATABASE comic_app;

USE COMIC_APP;


####################create table user####################
CREATE TABLE USER(
	id char(36) default (UUID()),
    user_name nvarchar(120),
    avatar varchar(255),
    email varchar(50),
    password varchar(150),
    uid varchar(150)
);

ALTER TABLE USER ADD PRIMARY KEY(`ID`);
	
INSERT INTO 
	USER(user_name, avatar, email, password, uid)
	VALUES
    ("Trần Anh Vũ", "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSoV9Vkw1HdxcZbzwb4F6nvk0ng3yIFbOfjBoHwdrrb4g2KDVOPK89fUrf11C2wYUF_qKA&usqp=CAU", "vutran789jjjj@gmail.com", "132456489", "654498465161");

SELECT * FROM USER;

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
    PUBLISH_BY CHAR(36) NOT NULL
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
 
 
####################create table reset-password####################

CREATE TABLE RESET_PASSWORD(
	ID CHAR(36) DEFAULT (UUID()),
	ID_USER CHAR(36) NOT NULL,
    EMAIL CHAR(255) NOT NULL,
    TOKEN VARCHAR(255) NOT NULL,
    CREATE_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    IS_AVAILABLE BIT DEFAULT 1
);

ALTER TABLE RESET_PASSWORD ADD CONSTRAINT FK_RESET_PASSWORD_USER FOREIGN KEY(ID_USER) REFERENCES USER(ID);
####################create table reset-password####################


####################create table country####################

CREATE TABLE IF NOT EXISTS `countries` (
	`ID` char(36) DEFAULT(UUID()),
    `CODE` char(2) NOT NULL,
    `NAME` varchar(100) NOT NULL
);

ALTER TABLE `COUNTRIES` ADD PRIMARY KEY(ID);

INSERT INTO `countries`(`code`, `name`) VALUES(
('AF', 'Afghanistan'),
('AX', 'Quần đảo Aland'),
('AL', 'Albania'),
('DZ', 'Algeria'),
('AS', 'American Samoa'),
('AD', 'Andorra'),
('AO', 'Angola'),
('AI', 'Anguilla'),
('AQ', 'Nam Cực'),
('AG', 'Antigua và Barbuda'),
('AR', 'Argentina'),
('AM', 'Armenia'),
('AW', 'Aruba'),
('AU', 'Châu Úc'),
('AT', 'Áo'),
('AZ', 'Azerbaijan'),
('BS', 'Bahamas'),
('BH', 'Bahrain'),
('BD', 'Bangladesh'),
('BB', 'Barbados'),
('BY', 'Belarus'),
('BE', 'nước Bỉ'),
('BZ', 'Belize'),
('BJ', 'Benin'),
('BM', 'Bermuda'),
('BT', 'Bhutan'),
('BO', 'Bolivia'),
('BQ', 'Bonaire, Sint Eustatius và Saba'),
('BA', 'Bosnia và Herzegovina'),
('BW', 'Botswana'),
('BV', 'Đảo Bouvet'),
('BR', 'Brazil'),
('IO', 'Lãnh thổ Ấn Độ Dương thuộc Anh'),
('BN', 'Vương quốc Bru-nây'),
('BG', 'Bungari'),
('BF', 'Burkina Faso'),
('BI', 'Burundi'),
('KH', 'Campuchia'),
('CM', 'Cameroon'),
('CA', 'Canada'),
('CV', 'Cape Verde'),
('KY', 'Quần đảo Cayman'),
('CF', 'Cộng hòa trung phi'),
('TD', 'Chad'),
('CL', 'Chile'),
('CN', 'Trung Quốc'),
('CX', 'Đảo giáng sinh'),
('CC', 'Quần đảo Cocos (Keeling)'),
('CO', 'Colombia'),
('KM', 'Comoros'),
('CG', 'Congo'),
('CD', 'Congo, Cộng hòa Dân chủ Congo'),
('CK', 'Quần đảo Cook'),
('CR', 'Costa Rica'),
('CI', 'Cote D\'Ivoire'),
('HR', 'Croatia'),
('CU', 'Cuba'),
('CW', 'rượu cam bì'),
('CY', 'Síp'),
('CZ', 'Cộng hòa Séc'),
('DK', 'Đan mạch'),
('DJ', 'Djibouti'),
('DM', 'Dominica'),
('DO', 'Cộng hòa Dominica'),
('EC', 'Ecuador'),
('EG', 'Ai cập'),
('SV', 'El Salvador'),
('GQ', 'Equatorial Guinea'),
('ER', 'Eritrea'),
('EE', 'Estonia'),
('ET', 'Ethiopia'),
('FK', 'Quần đảo Falkland (Malvinas)'),
('FO', 'Quần đảo Faroe'),
('FJ', 'Fiji'),
('FI', 'Phần Lan'),
('FR', 'Nước pháp'),
('GF', 'Guiana thuộc Pháp'),
('PF', 'Polynesia thuộc Pháp'),
('TF', 'Lãnh thổ phía Nam của Pháp'),
('GA', 'Gabon'),
('GM', 'Gambia'),
('GE', 'Georgia'),
('DE', 'nước Đức'),
('GH', 'Ghana'),
('GI', 'Gibraltar'),
('GR', 'Hy Lạp'),
('GL', 'Greenland'),
('GD', 'Grenada'),
('GP', 'Guadeloupe'),
('GU', 'Guam'),
('GT', 'Guatemala'),
('GG', 'Guernsey'),
('GN', 'Guinea'),
('GW', 'Guinea-Bissau'),
('GY', 'Guyana'),
('HT', 'Haiti'),
('HM', 'Đảo Heard và Quần đảo McDonald'),
('VA', 'Tòa thánh (Nhà nước thành phố Vatican)'),
('HN', 'Honduras'),
('HK', 'Hồng Kông'),
('HU', 'Hungary'),
('IS', 'Nước Iceland'),
('IN', 'Ấn Độ'),
('ID', 'Indonesia'),
('IR', 'Iran (Cộng hòa Hồi giáo'),
('IQ', 'I-rắc'),
('IE', 'Ireland'),
('IM', 'Đảo Man'),
('IL', 'Người israel'),
('IT', 'Nước Ý'),
('JM', 'Jamaica'),
('JP', 'Nhật Bản'),
('JE', 'Jersey'),
('JO', 'Jordan'),
('KZ', 'Kazakhstan'),
('KE', 'Kenya'),
('KI', 'Kiribati'),
('KP', 'Hàn Quốc, Cộng hòa Dân chủ Nhân dân'),
('KR', 'Hàn Quốc, Cộng hòa'),
('XK', 'Kosovo'),
('KW', 'Kuwait'),
('KG', 'Kyrgyzstan'),
('LA', 'Cộng hòa Dân chủ nhân dân Lào'),
('LV', 'Latvia'),
('LB', 'Lebanon'),
('LS', 'Lesotho'),
('LR', 'Liberia'),
('LY', 'Libyan Arab Jamahiriya'),
('LI', 'Liechtenstein'),
('LT', 'Lithuania'),
('LU', 'Luxembourg'),
('MO', 'Macao'),
('MK', 'Macedonia, Cộng hòa Nam Tư cũ của'),
('MG', 'Madagascar'),
('MW', 'Malawi'),
('MY', 'Malaysia'),
('MV', 'Maldives'),
('ML', 'Mali'),
('MT', 'Malta'),
('MH', 'đảo Marshall'),
('MQ', 'Martinique'),
('MR', 'Mauritania'),
('MU', 'Mauritius'),
('YT', 'Mayotte'),
('MX', 'Mexico'),
('FM', 'Micronesia, Liên bang'),
('MD', 'Moldova, Cộng hòa'),
('MC', 'Monaco'),
('MN', 'Mông Cổ'),
('ME', 'Montenegro'),
('MS', 'Montserrat'),
('MA', 'Maroc'),
('MZ', 'Mozambique'),
('MM', 'Myanmar'),
('NA', 'Namibia'),
('NR', 'Nauru'),
('NP', 'Nepal'),
('NL', 'nước Hà Lan'),
('AN', 'Đảo Antilles của Hà Lan'),
('NC', 'New Caledonia'),
('NZ', 'New Zealand'),
('NI', 'Nicaragua'),
('NE', 'Niger'),
('NG', 'Nigeria'),
('NU', 'Niue'),
('NF', 'Đảo Norfolk'),
('MP', 'Quần đảo Bắc Mariana'),
('NO', 'Na Uy'),
('OM', 'Oman'),
('PK', 'Pakistan'),
('PW', 'Palau'),
('PS', 'Lãnh thổ Palestine, bị chiếm đóng'),
('PA', 'Panama'),
('PG', 'Papua New Guinea'),
('PY', 'Paraguay'),
('PE', 'Peru'),
('PH', 'Phi-líp-pin'),
('PN', 'Pitcairn'),
('PL', 'Ba lan'),
('PT', 'Bồ Đào Nha'),
('PR', 'Puerto Rico'),
('QA', 'Qatar'),
('RE', 'Sum họp'),
('RO', 'Romania'),
('RU', 'Liên bang Nga'),
('RW', 'Rwanda'),
('BL', 'Saint Barthelemy'),
('SH', 'Saint Helena'),
('KN', 'Saint Kitts và Nevis'),
('LC', 'Saint Lucia'),
('MF', 'Saint martin'),
('PM', 'Saint Pierre và Miquelon'),
('VC', 'Saint Vincent và Grenadines'),
('WS', 'Samoa'),
('SM', 'San Marino'),
('ST', 'Sao Tome và Principe'),
('SA', 'Ả Rập Saudi'),
('SN', 'Senegal'),
('RS', 'Xéc-bi-a'),
('CS', 'Serbia và Montenegro'),
('SC', 'Seychelles'),
('SL', 'Sierra Leone'),
('SG', 'Singapore'),
('SX', 'St Martin'),
('SK', 'Xlô-va-ki-a'),
('SI', 'Slovenia'),
('SB', 'Quần đảo Solomon'),
('SO', 'Somalia'),
('ZA', 'Nam Phi'),
('GS', 'Nam Georgia và Quần đảo Nam Sandwich'),
('SS', 'phía nam Sudan'),
('ES', 'Tây ban nha'),
('LK', 'Sri Lanka'),
('SD', 'Sudan'),
('SR', 'Suriname'),
('SJ', 'Svalbard và Jan Mayen'),
('SZ', 'Swaziland'),
('SE', 'Thụy Điển'),
('CH', 'Thụy sĩ'),
('SY', 'Cộng Hòa Arab Syrian'),
('TW', 'Đài Loan, tỉnh của Trung Quốc'),
('TJ', 'Tajikistan'),
('TZ', 'Tanzania, Cộng hòa Thống nhất'),
('TH', 'nước Thái Lan'),
('TL', 'Timor-Leste'),
('TG', 'Đi'),
('TK', 'Tokelau'),
('TO', 'Tonga'),
('TT', 'Trinidad và Tobago'),
('TN', 'Tunisia'),
('TR', 'gà tây'),
('TM', 'Turkmenistan'),
('TC', 'Quần đảo Turks và Caicos'),
('TV', 'Tuvalu'),
('UG', 'Uganda'),
('UA', 'Ukraine'),
('AE', 'các Tiểu Vương Quốc Ả Rập Thống Nhất'),
('GB', 'Vương quốc Anh'),
('US', 'Hoa Kỳ'),
('UM', 'Các đảo nhỏ xa xôi hẻo lánh của Hoa Kỳ'),
('UY', 'Uruguay'),
('UZ', 'U-dơ-bê-ki-xtan'),
('VU', 'Vanuatu'),
('VE', 'Venezuela'),
('VN', 'Việt Nam'),
('VG', 'Quần đảo Virgin thuộc Anh'),
('VI', 'Quần đảo Virgin, Hoa Kỳ'),
('WF', 'Wallis và Futuna'),
('EH', 'Phía tây Sahara'),
('YE', 'Yemen'),
('ZM', 'Zambia'),
('ZW', 'Zimbabwe')
);


####################create table country####################

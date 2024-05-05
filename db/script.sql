create DATABASE if NOT EXISTS TEST_DATABASE;

use TEST_DATABASE;

create table
    user (
        id VARCHAR(40) PRIMARY KEY,
        user_name VARCHAR(50) NOT NULL,
        avatar VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL,
        uid VARCHAR(40)
    );

insert into
    user (
        id,
        user_name,
        avatar,
        email,
        password,
        uid
    )
values (
        'cb5da95e-ca64-43d1-8881-adff879f0865',
        'Valle',
        'http://dummyimage.com/249x100.png/cc0000/ffffff',
        'vaindrais0@state.gov',
        '$2a$04$N3BCqPuwJkNPzO6RUWHKU.',
        'd5c3462a-3a55-4128-b2e8-83579d3e6f22'
    );

insert into
    user (
        id,
        user_name,
        avatar,
        email,
        password,
        uid
    )
values (
        '68f2d4dc-5a0d-4a92-a13d-4a842db30b0e',
        'Flora',
        'http://dummyimage.com/182x100.png/cc0000/ffffff',
        'fbibb1@wordpress.org',
        '$2a$04$IIklgDnKcs1WuNrCU/LwV.',
        'fd33bf7d-8614-4ecc-89d4-08d0867093a7'
    );

insert into
    user (
        id,
        user_name,
        avatar,
        email,
        password,
        uid
    )
values (
        'df0e3127-9ba2-4aaf-b136-9539c7cb02c1',
        'Isidoro',
        'http://dummyimage.com/190x100.png/cc0000/ffffff',
        'isiddele2@diigo.com',
        '$2a$04$.dcpHEUR9Q.jQhFqE.i3WOt',
        'fcd2c268-ac60-493a-8493-79e7d2b79c88'
    );

insert into
    user (
        id,
        user_name,
        avatar,
        email,
        password,
        uid
    )
values (
        'cbcfc314-2c91-42c1-b221-9b94b6714413',
        'Holt',
        'http://dummyimage.com/156x100.png/ff4444/ffffff',
        'hneeson3@sogou.com',
        '$2a$04$rrhDm/a.W0rOxavuxD6c.ejgn',
        '16302f22-d11e-46a2-9343-2eeea55470a7'
    );

insert into
    user (
        id,
        user_name,
        avatar,
        email,
        password,
        uid
    )
values (
        '35f649b0-d026-40a6-bdcf-79a98de1dc77',
        'Rene',
        'http://dummyimage.com/211x100.png/5fa2dd/ffffff',
        'rolennachain4@exblog.jp',
        '$2a$04$vgFGhf/wjN4f5VBZz1H.rOt',
        'e4dbeebc-20b9-4d67-9f0a-696dfc632592'
    );

insert into
    user (
        id,
        user_name,
        avatar,
        email,
        password,
        uid
    )
values (
        'd27dd67d-625e-4f60-925b-9776095d1f90',
        'Stacie',
        'http://dummyimage.com/221x100.png/cc0000/ffffff',
        'sbossingham5@chicagotribune.com',
        '$2a$04$2XDDAIho/RBUCyl29y4DmOI',
        'ecbd07f5-ecbb-4a3e-b20f-ecdeb703a261'
    );

insert into
    user (
        id,
        user_name,
        avatar,
        email,
        password,
        uid
    )
values (
        'c965013c-2507-4438-adcd-a00416caecd3',
        'Byran',
        'http://dummyimage.com/126x100.png/cc0000/ffffff',
        'bgood6@hp.com',
        '$2a$04$SIve070n46AlFgf3BWxxyuv',
        'fe3c3258-cc74-45f7-8747-de4d71cd4295'
    );

insert into
    user (
        id,
        user_name,
        avatar,
        email,
        password,
        uid
    )
values (
        '5844220c-ee93-4292-8fd2-0e13b0405847',
        'Jeanine',
        'http://dummyimage.com/250x100.png/dddddd/000000',
        'jtomkies7@cpanel.net',
        '$2a$04$CjQZg/JK9/x176aJqoRIdu',
        'e22eb13b-8de6-4547-8a07-806c48f5f932'
    );

insert into
    user (
        id,
        user_name,
        avatar,
        email,
        password,
        uid
    )
values (
        'c690d870-62e5-484d-be2a-86d5c4f0cec9',
        'Kathe',
        'http://dummyimage.com/138x100.png/ff4444/ffffff',
        'kjockle8@about.me',
        '$2a$04$Dd3xkB0XqduSxDCdmAD60',
        '9bbc0984-af3f-4320-bffb-cebd47ca13e4'
    );

insert into
    user (
        id,
        user_name,
        avatar,
        email,
        password,
        uid
    )
values (
        '5c13a8d5-39bf-49b2-bd28-1d0efa7af32e',
        'Em',
        'http://dummyimage.com/225x100.png/5fa2dd/ffffff',
        'eclemmens9@histats.com',
        '$2a$04$zyqVh4BdYmPagki4fZR.',
        'f1263914-b02b-463f-92bb-9c0716c61898'
    );

create table
    reset_password(
        id VARCHAR(50) PRIMARY KEY,
        email VARCHAR(50) NOT NULL,
        token VARCHAR(50) NOT NULL,
        createAt DATETIME NOT NULL DEFAULT NOW(),
        available BIT DEFAULT 1
    );

create table
    if not exists categories (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        image VARCHAR(50) NOT NULL
    );

insert into
    categories (id, name, image)
values (
        1,
        'Điện thoại',
        'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg'
    );

insert into
    categories (id, name, image)
values (
        2,
        'Laptop',
        'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg'
    );

insert into
    categories (id, name, image)
values (
        3,
        'Phụ kiện',
        'https://asianwiki.com/images/d/de/Chi_P'
    );

create table
    if not exists products (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        price INT NOT NULL,
        image VARCHAR(255) NOT NULL,
        description VARCHAR(50) NOT NULL,
        quantity INT NOT NULL,
        categoryId INT NOT NULL,
        FOREIGN KEY (categoryId) REFERENCES categories(id)
    );

insert into
    products (
        id,
        name,
        price,
        image,
        description,
        quantity,
        categoryId
    )
values (
        1,
        'Điện thoại 1',
        1000,
        'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg',
        'Điện thoại 1',
        10,
        1
    );

insert into
    products (
        id,
        name,
        price,
        image,
        description,
        quantity,
        categoryId
    )
values (
        2,
        'Điện thoại 2',
        2000,
        'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg',
        'Điện thoại 2',
        20,
        2
    );

insert into
    products (
        id,
        name,
        price,
        image,
        description,
        quantity,
        categoryId
    )
values (
        3,
        'Điện thoại 3',
        3000,
        'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg',
        'Điện thoại 3',
        30,
        3
    );
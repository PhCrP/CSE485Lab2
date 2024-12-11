CREATE DATABASE tintuc;
USE tintuc;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role INT NOT NULL CHECK (role IN (0, 1)) -- 0: người dùng, 1: quản trị viên
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    category_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE
);

insert into users (id, username, password, role) values (1, 'gshayes0', '$2a$04$k/QurzNhR2jNxAWbbw5hOe.xHdK0PLlUq8dAeBHHS6Bw.mEADo3p2', 1);
insert into users (id, username, password, role) values (2, 'ghame1', '$2a$04$3emtp9T.gJRgBHSU4JlX9uw7U556DcWGutR4mIOP1KKDzDivDtGL.', 1);
insert into users (id, username, password, role) values (3, 'afrere2', '$2a$04$T3fcX1fFK/KKPkCdugj7EuzoeqzqXvT.xFoKX6eWIrcFmW48u3atq', 0);
insert into users (id, username, password, role) values (4, 'ecornbill3', '$2a$04$XBNPoyTVULTkfhuVkryhFujDx7Oj2J6bhP4aOEyki9n3PXn3CgZcS', 0);
insert into users (id, username, password, role) values (5, 'kmurkin4', '$2a$04$TLtamdGd7uxJTL3/idsSl.YdeLrc0C2S9pJ0vzuxdCpKl3MQT4Qo6', 1);
insert into users (id, username, password, role) values (6, 'dclemow5', '$2a$04$2qfJD.br9KVpFi/0/7PdsO6iBRLAYcRcXHDGX9NsoiC7Bw25OhfvS', 0);
insert into users (id, username, password, role) values (7, 'otaw6', '$2a$04$vOYMNodID.exlFITlC269eD.pDhJcyz/whTERre/IewEEu.DAjPu.', 0);
insert into users (id, username, password, role) values (8, 'egillogley7', '$2a$04$xPYUH3i9ONtZ5HS3t08cWOuPnFwcJT7HTXx0bONW3z.bGqQUxb1VK', 1);
insert into users (id, username, password, role) values (9, 'cotham8', '$2a$04$8IFIA1hIBqqg3qyoQ8RlpuqdNwZ/FtXhTLOjcIkadREJAfPxPNMZy', 1);
insert into users (id, username, password, role) values (10, 'mclute9', '$2a$04$NvVK/OaSz.NCbz2Fp/KNGujVAwj3jWJGKEcXw27Mg9pdLeHWySlv2', 0);
insert into users (id, username, password, role) values (11, 'cbertha', '$2a$04$E5Fav7CBVO7mQ5MbzK9T1e/r23kNSn3eQ2tgyEMskVgNI4l9eiS8a', 1);
insert into users (id, username, password, role) values (12, 'cdalgetyb', '$2a$04$d.cBbYBLRamJFuNasHqzQur/YXrwoRWo7sGuCNXqdvdtjNRzFIC0a', 0);
insert into users (id, username, password, role) values (13, 'mtomec', '$2a$04$ovfNKpJjG/H5uh.o140A0eSw04HfRMcHxz1JqwJ43r4UTJVp0/Ro2', 0);
insert into users (id, username, password, role) values (14, 'tcudbyd', '$2a$04$xKCsMElhMjjAVpK.S8UorOdk5u69efdPey88RWtx833J9h4KOqLwG', 0);
insert into users (id, username, password, role) values (15, 'lgludore', '$2a$04$tbZpqjq9CXh0KuxAuscKGe1zU9WQjP4tNAB8.ZUCfKfHLddYkyDo.', 1);
insert into users (id, username, password, role) values (16, 'pkhomishinf', '$2a$04$cfLc345orw1xiy8BlSFH4uAXr5X3a0lfkKW7kVlaxnLaR1u/oUAV2', 0);
insert into users (id, username, password, role) values (17, 'rdrissellg', '$2a$04$A1o/axGBUFdoBpdjHxB4b.2IJxa6zyzsSb51GGdWD/nveJrAf1H6q', 0);
insert into users (id, username, password, role) values (18, 'lhabdenh', '$2a$04$Glc6G0YKXGqx9xOxCfQUTe6aPdR/4GEVcF10IlbmVsTseKA5K5aE2', 1);
insert into users (id, username, password, role) values (19, 'tlawlancei', '$2a$04$1uLCM63hCKuZ1wR6TGyWjOCh7ZYnw7W6bMAlzoHvf/AfQ2FcPEZDW', 1);
insert into users (id, username, password, role) values (20, 'chailesj', '$2a$04$lftflXYCbgL4NEDfook56e8XHYT7QFQFFn3NXqY7KNzdsHiwqgnzy', 1);


insert into categories (name) values ('at nibh');
insert into categories (name) values ('ultrices phasellus');
insert into categories (name) values ('dolor morbi');
insert into categories (name) values ('posuere metus');
insert into categories (name) values ('vel est');
insert into categories (name) values ('suscipit');
insert into categories (name) values ('nulla nunc');
insert into categories (name) values ('dapibus duis');
insert into categories (name) values ('phasellus in');
insert into categories (name) values ('erat quisque');
insert into categories (name) values ('luctus');
insert into categories (name) values ('pharetra');
insert into categories (name) values ('purus');
insert into categories (name) values ('laoreet');
insert into categories (name) values ('mauris lacinia');
insert into categories (name) values ('ut');
insert into categories (name) values ('vestibulum ante');
insert into categories (name) values ('curabitur convallis');
insert into categories (name) values ('curabitur convallis');
insert into categories (name) values ('blandit');


SELECT * FROM users;
SELECT * FROM categories;
SELECT * FROM news;

SELECT title, content, name, image FROM news n INNER JOIN categories c WHERE n.category_id = c.id;

UPDATE news n SET title = 'title', content = 'content', category_id = 4, image = 'image1.jpg' WHERE n.id = 26;
       

DROP TABLE news;
DROP TABLE users;


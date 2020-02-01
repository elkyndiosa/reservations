CREATE DATABASE reservation;
USE reservation;
CREATE TABLE users(
id                  int(255) auto_increment not null,
nombre              varchar(255) not null,
email               varchar(255) not null,
phone               varchar(255) not null,
password            varchar(255) not null,
rol                 varchar(20) not null,
imagen              varchar(255),
registration_date   date not null,
CONSTRAINT pk_users PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=innoDB;
 
INSERT INTO users VALUES (null, 'admin' , 'admin@admin.com', 323323321, 'admin', 'admin', null, CURDATE());

CREATE TABLE site(
id      int(100) auto_increment not null,
nickname    varchar(255) not null,
CONSTRAINT pk_site PRIMARY KEY(id),
CONSTRAINT uq_nickname UNIQUE(nickname)
)ENGINE=innoDB;

INSERT INTO site VALUES(NULL, 'sabor a mar');

CREATE TABLE reservations(
id                  int(255) auto_increment not null,
id_users            int(255) not null,
id_site             int(255) not null,
people              int(255) not null,
reason              varchar(100) not null,
reservation_date    date not null,
reservation_time    time not null,
note                varchar(255),
status              varchar(100) not null,
date_realization    date not null,
modification_date   date,
CONSTRAINT pk_reservations PRIMARY KEY(id),
CONSTRAINT fk_reservations_site FOREIGN KEY(id_site) REFERENCES site(id),
CONSTRAINT fk_reservations_users FOREIGN KEY(id_users) REFERENCES users(id)
)ENGINE=innoDB;


INSERT INTO reservations VALUES (null, '1', '1', 12, 'birthday', CURDATE(), CURTIME(), null, 'active', CURDATE(), NULL); 
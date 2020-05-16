CREATE DATABASE IF NOT EXISTS storageLaravel;
USE storagelaravel;

CREATE TABLE users(
id int (255) auto_increment not null,
role varchar(20),
name varchar(255),
surname varchar(255),
email varchar(255),
password varchar(255),
image varchar(255),
created_at datetime,
updated_at datetime,
remember_token varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=INNODB;
/*------------------------------------------------------*/

CREATE TABLE videos(
id int(255) auto_increment not null,
user_id int(255) not null,
title varchar(255),
description text,
status varchar(20),
image varchar(255),
video_path varchar(255),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_videos PRIMARY KEY(id),
CONSTRAINT fk_videos_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=INNODB;

CREATE TABLE comments(
id int(255) auto_increment not null,
user_id int(255) not null,
video_id int(255),
body text,
created_at datetime,
updated_at datetime,
CONSTRAINT pk_comment PRIMARY KEY(id),
CONSTRAINT fk_comment_video FOREIGN KEY(video_id) REFERENCES videos(id),
CONSTRAINT fk_comment_user FOREIGN KEY(user_id)  REFERENCES users(id)
)ENGINE=INNODB;

/*------------------------------------------*/
CREATE TABLE audios(
id int(255) auto_increment not null,
user_id int(255) not null,
title varchar(255),
description text,
status varchar(20),
audio_path varchar(255),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_audios PRIMARY KEY(id),
CONSTRAINT fk_audios_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=INNODB;

CREATE TABLE commentsAudio(
id int(255) auto_increment not null,
user_id int(255) not null,
audio_id int(255),
body text,
created_at datetime,
updated_at datetime,
CONSTRAINT pk_commentAudio PRIMARY KEY(id),
CONSTRAINT fk_comment_audio FOREIGN KEY(audio_id) REFERENCES audios(id),
CONSTRAINT fk_comment_user_audios FOREIGN KEY(user_id)  REFERENCES users(id)
)ENGINE=INNODB;

/*------------------------------------------*/

CREATE TABLE docs(
id int(255) auto_increment not null,
user_id int(255) not null,
title varchar(255),
description text,
status varchar(20),
doc_path varchar(255),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_docs PRIMARY KEY(id),
CONSTRAINT fk_docs_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=INNODB;

CREATE TABLE commentsDocs(
id int(255) auto_increment not null,
user_id int(255) not null,
doc_id int(255),
body text,
created_at datetime,
updated_at datetime,
CONSTRAINT pk_commentDoc PRIMARY KEY(id),
CONSTRAINT fk_comment_doc FOREIGN KEY(doc_id) REFERENCES docs(id),
CONSTRAINT fk_comment_user-docs FOREIGN KEY(user_id)  REFERENCES users(id)
)ENGINE=INNODB;


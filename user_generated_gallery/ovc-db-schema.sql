CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	  username VARCHAR(255) NOT NULL UNIQUE,
	  name_last VARCHAR(255) NOT NULL,
	  name_first VARCHAR(255) NOT NULL,
	  email VARCHAR(255) NOT NULL,
    password CHAR(40) NOT NULL,
    group_id INT(11) NOT NULL,
    created DATETIME,
    modified DATETIME
);

 
CREATE TABLE groups (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created DATETIME,
    modified DATETIME
);


CREATE TABLE videos (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    kaltura_entry_id CHAR(40) NOT NULL,
    user_id INT(11) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    created DATETIME,
    modified DATETIME,
    approved BOOLEAN,
    flagged BOOLEAN,
    views INT(11)
);

CREATE TABLE collections (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    created DATETIME,
    modified DATETIME
);

CREATE TABLE collections_videos (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    collection_id INT(11) NOT NULL,
    video_id INT(11) NOT NULL,
);

CREATE TABLE collections_users (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    collection_id INT(11) NOT NULL,
    user_id INT(11) NOT NULL,
);

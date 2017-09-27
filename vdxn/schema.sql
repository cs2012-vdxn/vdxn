CREATE TABLE User (
	id INT AUTO_INCREMENT,
	username varchar(100) NOT NULL UNIQUE,
	password_hash varchar(1000) NOT NULL,
	contact varchar(100),
	email varchar(100),
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	user_type ENUM('Admin', 'User'),
	PRIMARY KEY (id)
);

CREATE TABLE Task (
	id INT NOT NULL AUTO_INCREMENT,
	title varchar(100) NOT NULL,
	description varchar(1000),
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	start_at DATETIME NOT NULL,
	end_at DATETIME,
	min_bid numeric,
	max_bid numeric,
	creator_id INT NOT NULL,
	assignee_id INT NOT NULL,
	deleted_at DATETIME,
	creator_rating numeric,
	assignee_rating numeric,
	completed_at DATETIME,
	PRIMARY KEY (id),
	FOREIGN KEY (creator_id) REFERENCES User(id) ON DELETE CASCADE,
	FOREIGN KEY (assignee_id) REFERENCES User(id) ON DELETE CASCADE
);

CREATE TABLE Category (
	name varchar(100) NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (name)
);

CREATE TABLE Category_task (
	category_name varchar(100) NOT NULL,
	task_id INT NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (category_name, task_id),
	FOREIGN KEY (category_name) REFERENCES Category(name) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (task_id) REFERENCES Task(id) ON DELETE CASCADE
);

CREATE TABLE Bid (
	id INT NOT NULL AUTO_INCREMENT,
	task_id INT NOT NULL,
	bidder_id INT NOT NULL,
	details varchar(200),
	amount numeric NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (id),
	FOREIGN KEY (task_id) REFERENCES Task(id) ON DELETE CASCADE,
	FOREIGN KEY (bidder_id) REFERENCES User(id) ON DELETE CASCADE
);

CREATE TABLE Tag (
	name varchar(100) NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (name)
);

CREATE TABLE Tag_task (
	tag_name varchar(100) NOT NULL,
	task_id INT NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (tag_name, task_id),
	FOREIGN KEY (tag_name) REFERENCES Tag(name) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (task_id) REFERENCES Task(id) ON DELETE CASCADE
);

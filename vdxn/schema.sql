CREATE TABLE User (
	username varchar(100) NOT NULL UNIQUE,
	first_name varchar(100),
	last_name varchar(100),
	password_hash varchar(1000) NOT NULL,
	contact varchar(100),
	email varchar(100),
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	user_type ENUM('Admin', 'User'),
	PRIMARY KEY (username)
);

CREATE TABLE Task (
	title varchar(100) NOT NULL,
	description varchar(1000),
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	start_at DATETIME NOT NULL,
	end_at DATETIME,
	min_bid numeric,
	max_bid numeric,
	creator_username varchar(100) NOT NULL,
	assignee_username varchar(100),
	creator_rating numeric,
	assignee_rating numeric,
	completed_at DATETIME,
	remarks varchar(1000),
	CONSTRAINT min_bid CHECK(min_bid < max_bid),
	CONSTRAINT end_at CHECK(start_at < end_at),
	PRIMARY KEY (creator_username, title),
	FOREIGN KEY (creator_username) REFERENCES User(username) ON DELETE CASCADE,
	FOREIGN KEY (assignee_username) REFERENCES User(username) ON DELETE CASCADE
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
	task_title varchar(100) NOT NULL,
	task_creator_username varchar(100) NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (category_name, task_title, task_creator_username),
	FOREIGN KEY (category_name) REFERENCES Category(name) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (task_creator_username) REFERENCES Task(creator_username) ON DELETE CASCADE,
	FOREIGN KEY (task_title) REFERENCES Task(title) ON DELETE CASCADE
);

CREATE TABLE Bid (
	task_title varchar(100) NOT NULL,
	task_creator_username varchar(100) NOT NULL,
	bidder_username varchar(100) NOT NULL,
	details varchar(200),
	amount numeric NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (task_title, task_creator_username, bidder_username),
	FOREIGN KEY (task_title) REFERENCES Task(title) ON DELETE CASCADE,
	FOREIGN KEY (task_creator_username) REFERENCES Task(creator_username) ON DELETE CASCADE,
	FOREIGN KEY (bidder_username) REFERENCES User(username) ON DELETE CASCADE
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
	task_creator_username varchar(100) NOT NULL,
	task_title varchar(100) NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (tag_name, task_title, task_creator_username),
	FOREIGN KEY (tag_name) REFERENCES Tag(name) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (task_creator_username) REFERENCES Task(creator_username) ON DELETE CASCADE,
	FOREIGN KEY (task_title) REFERENCES Task(title) ON DELETE CASCADE
);

CREATE TABLE User (
	username varchar(100),
	first_name varchar(100),
	last_name varchar(100),
	password_hash varchar(1000) NOT NULL,
	contact varchar(100),
	email varchar(100),
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	user_type ENUM('Admin', 'User'),
	PRIMARY KEY (username)
);

CREATE TABLE Task (
	title varchar(100),
	description varchar(1000),
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	start_at DATETIME NOT NULL,
	end_at DATETIME,
	min_bid numeric,
	max_bid numeric,
	creator_username varchar(100),
	assignee_username varchar(100),
	creator_rating numeric,
	assignee_rating numeric,
	completed_at DATETIME,
	remarks varchar(1000),
	CONSTRAINT min_bid CHECK(min_bid < max_bid),
	CONSTRAINT end_at CHECK(start_at < end_at),
	PRIMARY KEY (creator_username, title),
	FOREIGN KEY (creator_username) REFERENCES User(username) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (assignee_username) REFERENCES User(username) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Category (
	name varchar(100),
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	PRIMARY KEY (name)
);

CREATE TABLE Category_task (
	category_name varchar(100) REFERENCES Category(name) ON DELETE CASCADE ON UPDATE CASCADE,
	task_title varchar(100) REFERENCES Task(title) ON DELETE CASCADE,
	task_creator_username varchar(100) REFERENCES Task(creator_username) ON DELETE CASCADE ON UPDATE CASCADE,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	PRIMARY KEY (category_name, task_title, task_creator_username)
);

CREATE TABLE Bid (
	task_title varchar(100) REFERENCES Task(title) ON DELETE CASCADE ON UPDATE CASCADE,
	task_creator_username varchar(100) REFERENCES Task(creator_username) ON DELETE CASCADE ON UPDATE CASCADE,
	bidder_username varchar(100) REFERENCES User(username) ON DELETE CASCADE ON UPDATE CASCADE,
	details varchar(200),
	amount numeric NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	PRIMARY KEY (task_title, task_creator_username, bidder_username)
);

CREATE TABLE Tag (
	name varchar(100),
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	PRIMARY KEY (name)
);

CREATE TABLE Tag_task (
	tag_name varchar(100) REFERENCES Tag(name) ON DELETE CASCADE ON UPDATE CASCADE,
	task_creator_username varchar(100) REFERENCES Task(creator_username) ON DELETE CASCADE ON UPDATE CASCADE,
	task_title varchar(100) REFERENCES Task(title) ON DELETE CASCADE ON UPDATE CASCADE,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	PRIMARY KEY (tag_name, task_title, task_creator_username)
);

CREATE TABLE Months(
  value varchar(3),
  name varchar(100) PRIMARY KEY
);

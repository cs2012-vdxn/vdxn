DROP TABLE IF EXISTS Tag_task;
DROP TABLE IF EXISTS Category_task;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Tag;
DROP TABLE IF EXISTS Bid;
DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS User;

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
	assignee_username varchar(100) NOT NULL,
	deleted_at DATETIME,
	creator_rating numeric,
	assignee_rating numeric,
	completed_at DATETIME,
	remarks varchar(1000),
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
	category_name varchar(100) NOT NULL REFERENCES Category(name) ON DELETE CASCADE ON UPDATE CASCADE,
	task_title varchar(100) NOT NULL REFERENCES Task(title) ON DELETE CASCADE,
	task_creator_username varchar(100) NOT NULL REFERENCES Task(creator_username) ON DELETE CASCADE,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (category_name, task_title, task_creator_username)
);

CREATE TABLE Bid (
	task_title varchar(100) NOT NULL REFERENCES Task(title) ON DELETE CASCADE,
	task_creator_username varchar(100) NOT NULL REFERENCES Task(creator_username) ON DELETE CASCADE,
	bidder_username varchar(100) NOT NULL REFERENCES User(username) ON DELETE CASCADE,
	details varchar(200),
	amount numeric NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (task_title, task_creator_username, bidder_username)
);

CREATE TABLE Tag (
	name varchar(100) NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (name)
);

CREATE TABLE Tag_task (
	tag_name varchar(100) NOT NULL REFERENCES Tag(name) ON DELETE CASCADE ON UPDATE CASCADE,
	task_creator_username varchar(100) NOT NULL REFERENCES Task(creator_username) ON DELETE CASCADE,
	task_title varchar(100) NOT NULL REFERENCES Task(title) ON DELETE CASCADE,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (tag_name, task_title, task_creator_username)
);


INSERT INTO User(username, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('abc', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '91230123', 'abc@hotmail.com', '2017-09-22 00:00:00', NULL, NULL, 'Admin');
INSERT INTO User(username, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('ab', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '81234567', 'ab@gmail.com', '2017-09-22 00:00:00', NULL, NULL, 'User');

INSERT INTO Task (title, description, created_at, updated_at, start_at, min_bid, max_bid, creator_username, assignee_username, deleted_at, completed_at, creator_rating, assignee_rating) VALUES
('Feed my dog', 'I need my dog fed ', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Feed my donkey', 'I need my donkey primed for selling', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'ab', 'abc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Feed my hamster', 'I need my hamster fed ', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'ab', 'abc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Feed my cow', 'I need my cow primed for selling', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Feed my cat', 'I need my cat fat', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Wash my rabbit', 'I need my rabbit shiny white', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Walk my dog', 'I need my dog healthy', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Teach me how to do my homework', 'I need to save my CAP', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Cook lunch for me', 'I need to survive while doing homework', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Wash my car', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Buy my groceries', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Buy my air ticket', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'ab', 'abc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Collect my parcel', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Fetch my nephew from school', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'ab', 'abc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Paint my house', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Fix my bag', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

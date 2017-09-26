DROP TABLE IF EXISTS Tag_task;
DROP TABLE IF EXISTS Category_task;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Tag;
DROP TABLE IF EXISTS Bid;
DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS User;
CREATE TABLE User (
	id INT AUTO_INCREMENT,
	username varchar(100) NOT NULL UNIQUE,
	password_hash varchar(1000) NOT NULL,
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

INSERT INTO User(username, password_hash, created_at, updated_at, deleted_at, user_type) VALUES ('abc', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '2017-09-22 00:00:00', NULL, NULL, 'Admin');
INSERT INTO User(username, password_hash, created_at, updated_at, deleted_at, user_type) VALUES ('ab', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '2017-09-22 00:00:00', NULL, NULL, 'Admin');

INSERT INTO Task (title, description, created_at, updated_at, start_at, min_bid, max_bid, creator_id, assignee_id, deleted_at, completed_at, creator_rating, assignee_rating) VALUES
('Feed my dog', 'I need my dog fed ', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Feed my donkey', 'I need my donkey primed for selling', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

INSERT INTO Task (title, description, created_at, updated_at, start_at, min_bid, max_bid, creator_id, assignee_id, deleted_at, completed_at, creator_rating, assignee_rating) VALUES
('Feed my hamster', 'I need my hamster fed ', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Feed my cow', 'I need my cow primed for selling', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Feed my cat', 'I need my cat fat', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Wash my rabbit', 'I need my rabbit shiny white', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 2,1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Walk my dog', 'I need my dog healthy', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 2,1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Teach me how to do my homework', 'I need to save my CAP', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Cook lunch for me', 'I need to survive while doing homework', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Wash my car', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Buy my groceries', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Buy my air ticket', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Collect my parcel', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100,2,1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Fetch my nephew from school', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Paint my house', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Fix my bag', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

DROP TABLE IF EXISTS Tag_task;
DROP TABLE IF EXISTS Category_task;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Tag;
DROP TABLE IF EXISTS Bid;
DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Months;

CREATE TABLE User (
	username varchar(100),
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
	name varchar(100),
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (name)
);

CREATE TABLE Category_task (
	category_name varchar(100) REFERENCES Category(name) ON DELETE CASCADE ON UPDATE CASCADE,
	task_title varchar(100) REFERENCES Task(title) ON DELETE CASCADE,
	task_creator_username varchar(100) REFERENCES Task(creator_username) ON DELETE CASCADE,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (category_name, task_title, task_creator_username)
);

CREATE TABLE Bid (
	task_title varchar(100) REFERENCES Task(title) ON DELETE CASCADE,
	task_creator_username varchar(100) REFERENCES Task(creator_username) ON DELETE CASCADE,
	bidder_username varchar(100) REFERENCES User(username) ON DELETE CASCADE,
	details varchar(200),
	amount numeric NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (task_title, task_creator_username, bidder_username)
);

CREATE TABLE Tag (
	name varchar(100),
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (name)
);

CREATE TABLE Tag_task (
	tag_name varchar(100) REFERENCES Tag(name) ON DELETE CASCADE ON UPDATE CASCADE,
	task_creator_username varchar(100) REFERENCES Task(creator_username) ON DELETE CASCADE,
	task_title varchar(100) REFERENCES Task(title) ON DELETE CASCADE,
	created_at DATETIME NOT NULL,
	updated_at DATETIME,
	deleted_at DATETIME,
	PRIMARY KEY (tag_name, task_title, task_creator_username)
);

CREATE TABLE Months(
  value varchar(3),
  name varchar(100) PRIMARY KEY
);

-- 2 Users with user_type 'Admin', generated from freedatagenerator, declared
-- here due to dependencies with other Bid/Task queries below
-- The other INSERT queries can be found below
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('abc', 'Malia', 'Smith', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '99988386', 'Mal.SM4559@yopmail.com', '2010-02-24', null, null, 'Admin');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('ab', 'Chaim', 'Mclaughlin', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '99927547', 'Chaim.MCLAU9863@reallymymail.com', '2010-01-25', null, null, 'Admin');

INSERT INTO `mini`.`Bid` (`task_title`, `task_creator_username`, `bidder_username`, `details`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Wash all my clothes', 'abc', 'ab', NULL, '10', '2017-09-04 00:00:00', NULL, NULL),
('Clean my house', 'abc', 'ab', NULL, '10', '2017-09-04 00:00:00', NULL, NULL),
('Water my lawn', 'abc', 'ab', NULL, '10', '2017-09-04 00:00:00', NULL, NULL);

INSERT INTO `mini`.`Bid` (`task_title`, `task_creator_username`, `bidder_username`, `details`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Feed my dog', 'ab', 'abc', NULL, '10', '2017-09-04 00:00:00', NULL, NULL),
('Feed my dog', 'abc', 'keafranc1388', NULL, '50', '2017-09-06 00:00:00', NULL, NULL),
('Feed my dog', 'abc', 'jamajense5492', NULL, '24', '2017-09-14 00:00:00', NULL, NULL),
('Carry a large TV to my room', 'abc', 'ab', NULL, '10', '2017-09-04 00:00:00', NULL, NULL),
('Fetch my nephew from school', 'ab', 'abc', NULL, '10', '2017-09-04 00:00:00', NULL, NULL);

INSERT INTO Task (title, description, created_at, updated_at, start_at, min_bid, max_bid, creator_username, assignee_username, deleted_at, completed_at, creator_rating, assignee_rating) VALUES
('Feed my dogs', 'I need my dog fed ', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Feed my donkey', 'I need my donkey primed for selling', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'ab', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Feed my hamster', 'I need my hamster fed ', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'ab', 'abc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Feed my cow', 'I need my cow primed for selling', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', NULL, 0, 0),
('Feed my fat cat', 'I need my cat fat', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Wash my rabbit', 'I need my rabbit shiny white', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Walk my doggy', 'I need my dog healthy', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Teach me how to do my homework', 'I need to save my CAP', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Cook lunch for me', 'I need to survive while doing homework', '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Wash my car', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Buy my air ticket', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'ab', 'abc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Collect my parcel', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Fetch my nephew from school', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'ab', 'abc', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Paint my house', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
('Fix my bag', NULL, '2017-09-22 00:00:00', '2017-09-22 00:00:00', '2017-09-30 00:00:00', 1, 100, 'abc', 'ab', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

-- ========================================================================
-- Seeds generated from http://www.freedatagenerator.com/sql-data-generator
-- Refer to freedatagenerator_savefile.txt to see how to import these seed settings

-- === IMPORTANT ===
-- 1. The first 2 users are Admins and you can log in using the username 'abc' & password 'abc'.
-- 2. There are numerous duplicate data entries, so you'll see some errors
--    in your SQL queries. Just ignore them and about 100 tasks should be
--    added to your database anyways
-- ========================================================================
-- Users
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('rylatkinson5547', 'Rylie', 'Atkinson', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '98038781', 'Ryl.ATKINSO1315@dispostable.com', '2010-02-12', null, null, 'User');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('keafranc1388', 'Keaton', 'Franco', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '95182761', 'Kea.FRA1698@reallymymail.com', '2010-02-04', null, null, 'User');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('jamajense5492', 'Jamar', 'Jensen', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '93949770', 'Jamar.JEN6088@mailinator.com', '2010-01-17', null, null, 'User');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('mivincent4274', 'Milan', 'Vincent', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '94862727', 'Milan.VINCENT4820@yopmail.com', '2010-01-31', null, null, 'User');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('khloevillar8727', 'Khloe', 'Villarreal', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '96054531', 'Khlo.VILLAR8952@dispostable.com', '2010-02-02', null, null, 'User');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('yamilro1115', 'Yamileth', 'Roy', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '92260059', 'Yamile.ROY5940@reallymymail.com', '2010-02-20', null, null, 'User');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('alyviasteph8157', 'Alyvia', 'Stephens', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '99888025', 'Alyv.STEPHENS7845@monumentmail.com', '2010-01-21', null, null, 'User');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('allenbisho4523', 'Allen', 'Bishop', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '97836769', 'Allen.BISH8097@yopmail.com', '2010-01-13', null, null, 'User');

INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('pikachu', 'Pi', 'Kachu', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '98038781', 'pikachu@gmail.com', '2010-02-12', null, null, 'Admin');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('pusheen', 'Pusheen', 'Franco', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '95182761', 'pusheen@gmail.com', '2010-02-04', null, null, 'Admin');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('derek', 'Derek', 'Nam', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '93949770', 'derek@gmail.com', '2010-01-17', null, null, 'Admin');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('nat', 'Nat', 'Koh', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '94862727', 'nat@gmail.com', '2010-01-31', null, null, 'Admin');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('xiao', 'Xiao','', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '96054531', 'xiao@gmail.com', '2010-02-02', null, null, 'Admin');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('wei', 'Wei','', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '92260059', 'wei@gmail.com', '2010-02-20', null, null, 'Admin');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('tuong', 'NTV', '', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '99888025', 'tuong@gmail.com', '2010-01-21', null, null, 'Admin');
INSERT INTO User (username, first_name, last_name, password_hash, contact, email, created_at, updated_at, deleted_at, user_type) VALUES ('van', 'Tuong', 'Van', '$2y$10$/4oRrwEAJ1kKsszjFA4ITeQ6ZjRyL8oSx3scdwhTECf5YDVc6m/sy', '97836769', 'van@gmail.com', '2010-01-13', null, null, 'Admin');



-- Each User's / Admin's Tasks
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash all my clothes', 'Am usually kind with strangers.', '2010-05-25', null, '2010-06-03','2010-06-04' , 41, 303, 'abc', null, '2010-09-14', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Water my lawn', 'Need someone who is responsible and well-trained.', '2010-05-02', null, '2010-06-18 12:00:00', '2010-06-18 13:00:00', 20, 57, 'abc', null, '2010-08-20', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Trim my lawn', 'I''m old, any kind souls please?', '2010-05-10', null, '2010-06-15 11:00:00', '2010-06-15 12:00:00', 19, 237, 'abc', null, '2010-08-01', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Buy my groceries', 'Need urgent help, please ping me.', '2010-05-11', null, '2010-06-19 15:30:00', '2010-06-19 16:00:00', 33, 389, 'abc', null, '2010-08-13', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash my curtains', 'Assist me and will reward handsomely.', '2010-05-09', null, '2010-06-28 20:00:00', '2010-06-28 21:00:00', 35, 436, 'abc', null, '2010-09-06', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my cat', 'Am usually kind with strangers.', '2010-05-13', null, '2010-06-07 18:00:00', '2010-06-7 19:30:00', 12, 85, 'ab', null, '2010-08-17', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my motorcycle', 'Assist me and will reward handsomely.', '2010-04-12', null, '2010-06-02 15:00:00', '2010-06-02 16:00:00', 28, 473, 'abc', null, '2010-09-20', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my cat', 'Assist me and will reward handsomely.', '2010-05-15', null, '2010-06-01 15:00:00', '2010-06-01 16:00:00', 44, 132, 'abc', null, '2010-08-07', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Carry a large TV to my room', 'Am usually kind with strangers.', '2010-04-28', null, '2010-06-05 6:00:00', '2010-06-05 6:00:00', 27, 373, 'abc', null, '2010-09-22', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my dog', 'Need someone who is responsible and well-trained.', '2010-04-12', null, '2010-06-17 7:00:00', '2010-06-17 7:45:00', 34, 142, 'abc', null, '2010-08-15', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my house plumbing', 'I pay well and usually engage with task doers I like repeatedly', '2010-05-18', null, '2010-06-09', null, 17, 431, 'abc', null, '2010-08-24', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Clean my house', 'Want professional help', '2010-05-29', null, '2010-06-03', null, 29, 414, 'abc', null, '2010-09-28', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my motorcycle', 'Help me and I will pay you well.', '2010-04-08', null, '2010-06-09', null, 22, 192, 'ab', null, '2010-08-28', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my dog', 'Please help!', '2010-04-04', null, '2010-06-28', null, 5, 193, 'ab', null, '2010-08-27', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Carry a large TV to my kitchen', 'I''m old, any kind souls please?', '2010-04-05', null, '2010-06-16', null, 5, 72, 'ab', null, '2010-08-25', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my doorbells', 'Need anyone with any profession! This is urgent!', '2010-04-24', null, '2010-06-07', null, 40, 81, 'ab', null, '2010-09-25', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my doggy', 'I''m old, any kind souls please?', '2010-04-15', null, '2010-06-19', null, 35, 56, 'ab', null, '2010-08-26', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my doors', 'Need anyone with any profession! This is urgent!', '2010-05-26', null, '2010-06-24', null, 43, 382, 'ab', null, '2010-08-23', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash all my clothes', 'This task is not as hard as it seems.', '2010-04-06', null, '2010-06-22', null, 8, 493, 'ab', null, '2010-08-15', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my cat please', 'Am usually kind with strangers.', '2010-05-20', null, '2010-06-10', null, 45, 390, 'rylatkinson5547', null, '2010-09-18', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash my curtains', 'Need urgent help, please ping me.', '2010-05-28', null, '2010-06-05', null, 47, 387, 'rylatkinson5547', null, '2010-08-11', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my motorcycle', 'This task is not as hard as it seems.', '2010-05-12', null, '2010-06-06', null, 39, 211, 'rylatkinson5547', null, '2010-09-01', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my house plumbing', 'Need urgent help, please ping me.', '2010-05-02', null, '2010-06-19', null, 12, 257, 'rylatkinson5547', null, '2010-08-16', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Collect my parcel', 'Want professional help', '2010-04-03', null, '2010-06-12', null, 25, 388, 'rylatkinson5547', null, '2010-09-02', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Mend my old shoes', 'Looking for experienced doers.', '2010-05-16', null, '2010-06-02', null, 47, 249, 'rylatkinson5547', null, '2010-09-22', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my motorcycles', 'Need urgent help, please ping me.', '2010-05-25', null, '2010-06-19', null, 41, 337, 'rylatkinson5547', null, '2010-09-07', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Teach me how to do my homework', 'Am generous with the pay.', '2010-04-26', null, '2010-06-16', null, 47, 143, 'rylatkinson5547', null, '2010-08-15', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Buy my groceries', 'Am generous with the pay.', '2010-05-17', null, '2010-06-18', null, 34, 402, 'rylatkinson5547', null, '2010-09-14', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Carry a large TV to my room', 'Need someone who is responsible and well-trained.', '2010-05-15', null, '2010-06-25', null, 9, 451, 'rylatkinson5547', null, '2010-09-22', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Collect my parcels', 'Want professional help', '2010-05-02', null, '2010-06-16', null, 44, 246, 'rylatkinson5547', null, '2010-09-08', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Clean my kitch', 'Want professional help', '2010-04-15', null, '2010-06-11', null, 24, 120, 'rylatkinson5547', null, '2010-08-15', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my cat', 'Help me and I will pay you well.', '2010-04-23', null, '2010-06-18', null, 44, 183, 'rylatkinson5547', null, '2010-08-18', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Clean my desk', 'Help me and I will pay you well.', '2010-05-13', null, '2010-06-23', null, 33, 211, 'rylatkinson5547', null, '2010-09-30', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my bike', 'I''m old, any kind souls please?', '2010-05-09', null, '2010-06-10', null, 13, 471, 'keafranc1388', null, '2010-08-23', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash all my clothes', 'This task is not as hard as it seems.', '2010-04-15', null, '2010-06-16', null, 8, 190, 'keafranc1388', null, '2010-08-22', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my house plumbing', 'Assist me and will reward handsomely.', '2010-04-01', null, '2010-06-02', null, 39, 409, 'keafranc1388', null, '2010-08-06', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash my clothes', 'Please help!', '2010-04-10', null, '2010-06-29', null, 24, 100, 'keafranc1388', null, '2010-09-13', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my doorbell', 'I pay well and usually engage with task doers I like repeatedly', '2010-05-12', null, '2010-06-18', null, 39, 305, 'keafranc1388', null, '2010-09-13', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my cat', 'I pay well and usually engage with task doers I like repeatedly', '2010-04-15', null, '2010-06-06', null, 47, 483, 'keafranc1388', null, '2010-08-20', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my cats', 'Please help!', '2010-05-26', null, '2010-06-15', null, 44, 316, 'keafranc1388', null, '2010-09-15', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my doorbellss', 'Assist me and will reward handsomely.', '2010-05-17', null, '2010-06-17', null, 22, 284, 'keafranc1388', null, '2010-08-07', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Teach me how to do my homework', 'Want professional help', '2010-05-09', null, '2010-06-06', null, 14, 352, 'keafranc1388', null, '2010-08-08', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my dog', 'Need anyone with any profession! This is urgent!', '2010-04-25', null, '2010-06-15', null, 37, 387, 'keafranc1388', null, '2010-09-16', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my motorcycle', 'Am generous with the pay.', '2010-05-23', null, '2010-06-17', null, 12, 302, 'keafranc1388', null, '2010-09-27', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Clean my house', 'Assist me and will reward handsomely.', '2010-04-29', null, '2010-06-03', null, 27, 245, 'jamajense5492', null, '2010-08-30', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Mend my old bike', 'I pay well and usually engage with task doers I like repeatedly', '2010-04-13', null, '2010-06-12', null, 38, 410, 'jamajense5492', null, '2010-09-16', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash all my clothes', 'This task is not as hard as it seems.', '2010-04-24', null, '2010-06-22', null, 33, 371, 'jamajense5492', null, '2010-08-02', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Carry a large box to my room', 'Am usually kind with strangers.', '2010-05-08', null, '2010-06-25', null, 7, 79, 'jamajense5492', null, '2010-09-22', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Teach me how to do my homework', 'I''m old, any kind souls please?', '2010-04-04', null, '2010-06-14', null, 8, 395, 'jamajense5492', null, '2010-08-10', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my kitties', 'Help me and I will pay you well.', '2010-04-16', null, '2010-06-19', null, 24, 379, 'jamajense5492', null, '2010-09-10', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my house plumbing', 'Assist me and will reward handsomely.', '2010-04-21', null, '2010-06-30', null, 14, 188, 'jamajense5492', null, '2010-08-27', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash my curtains', 'This task is not as hard as it seems.', '2010-05-12', null, '2010-06-26', null, 41, 118, 'jamajense5492', null, '2010-08-24', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Buy my groceries', 'Need urgent help, please ping me.', '2010-04-16', null, '2010-06-03', null, 25, 271, 'jamajense5492', null, '2010-09-17', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Teach me how to do my homework', 'I pay well and usually engage with task doers I like repeatedly', '2010-04-10', null, '2010-06-22', null, 28, 102, 'mivincent4274', null, '2010-08-08', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Carry a large bike to my room', 'Need urgent help, please ping me.', '2010-05-07', null, '2010-06-17', null, 49, 217, 'mivincent4274', null, '2010-09-04', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash my curtains', 'Need someone who is responsible and well-trained.', '2010-05-08', null, '2010-06-22', null, 8, 268, 'mivincent4274', null, '2010-08-14', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Carry a large TV to my room', 'Am usually kind with strangers.', '2010-05-21', null, '2010-06-16', null, 20, 112, 'mivincent4274', null, '2010-09-06', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Mend my old shoes', 'Assist me and will reward handsomely.', '2010-05-21', null, '2010-06-08', null, 16, 70, 'mivincent4274', null, '2010-09-20', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Assist me in Spring Cleaning', 'I pay well and usually engage with task doers I like repeatedly', '2010-04-18', null, '2010-06-06', null, 40, 471, 'mivincent4274', null, '2010-09-08', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Mend my old shoes pls', 'Need someone who is responsible and well-trained.', '2010-05-14', null, '2010-06-29', null, 24, 93, 'mivincent4274', null, '2010-09-05', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Mend my old shoe', 'This task is not as hard as it seems.', '2010-05-06', null, '2010-06-23', null, 47, 162, 'mivincent4274', null, '2010-08-04', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my motorcycle', 'This task is not as hard as it seems.', '2010-05-29', null, '2010-06-07', null, 35, 255, 'mivincent4274', null, '2010-09-02', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my dog', 'Please help!', '2010-04-14', null, '2010-06-09', null, 39, 200, 'mivincent4274', null, '2010-08-31', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my house plumbing', 'Help me and I will pay you well.', '2010-04-07', null, '2010-06-06', null, 40, 180, 'mivincent4274', null, '2010-09-04', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Carry a large TV to my table', 'Looking for experienced doers.', '2010-04-14', null, '2010-06-19', null, 16, 452, 'mivincent4274', null, '2010-09-25', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Water my lawns', 'Help me and I will pay you well.', '2010-05-29', null, '2010-06-14', null, 14, 428, 'mivincent4274', null, '2010-09-20', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my doorbells', 'Need anyone with any profession! This is urgent!', '2010-05-04', null, '2010-06-12', null, 19, 235, 'mivincent4274', null, '2010-08-13', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Collect my parcel', 'Looking for experienced doers.', '2010-04-05', null, '2010-06-14', null, 10, 195, 'mivincent4274', null, '2010-09-17', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Assist me in Spring Cleaning', 'Need anyone with any profession! This is urgent!', '2010-05-29', null, '2010-06-03', null, 22, 373, 'yamilro1115', null, '2010-08-09', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my motorcycle', 'Need urgent help, please ping me.', '2010-04-27', null, '2010-06-18', null, 29, 220, 'yamilro1115', null, '2010-09-26', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Collect my parcel', 'Am usually kind with strangers.', '2010-05-24', null, '2010-06-17', null, 9, 449, 'yamilro1115', null, '2010-08-23', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my house plumbing', 'Looking for experienced doers.', '2010-05-04', null, '2010-06-13', null, 42, 83, 'yamilro1115', null, '2010-08-25', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Teach me how to do my homework', 'Want professional help', '2010-04-03', null, '2010-06-15', null, 36, 443, 'yamilro1115', null, '2010-08-23', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash all my clothes', 'Assist me and will reward handsomely.', '2010-04-20', null, '2010-06-06', null, 5, 461, 'yamilro1115', null, '2010-08-24', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my dog', 'Help me and I will pay you well.', '2010-05-10', null, '2010-06-09', null, 15, 76, 'yamilro1115', null, '2010-09-05', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my car', 'Need urgent help, please ping me.', '2010-04-18', null, '2010-06-03', null, 21, 472, 'yamilro1115', null, '2010-09-23', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my door', 'Please help!', '2010-04-23', null, '2010-06-28', null, 43, 211, 'yamilro1115', null, '2010-08-31', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Mend my old table', 'Help me and I will pay you well.', '2010-05-09', null, '2010-06-23', null, 27, 430, 'yamilro1115', null, '2010-08-11', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Water my lawn', 'I''m old, any kind souls please?', '2010-05-28', null, '2010-06-17', null, 26, 262, 'yamilro1115', null, '2010-09-27', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Water my garden', 'Assist me and will reward handsomely.', '2010-05-13', null, '2010-06-11', null, 20, 392, 'yamilro1115', null, '2010-09-08', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my doorbell', 'Looking for experienced doers.', '2010-04-29', null, '2010-05-31', null, 36, 412, 'yamilro1115', null, '2010-09-04', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Clean my house', 'Need anyone with any profession! This is urgent!', '2010-05-02', null, '2010-06-26', null, 18, 71, 'yamilro1115', null, '2010-08-07', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fix my motorcycle', 'Am generous with the pay.', '2010-04-25', null, '2010-06-22', null, 14, 440, 'alyviasteph8157', null, '2010-09-18', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Clean my house', 'Need anyone with any profession! This is urgent!', '2010-05-04', null, '2010-06-24', null, 35, 68, 'alyviasteph8157', null, '2010-08-17', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Buy my groceries', 'Am usually kind with strangers.', '2010-04-29', null, '2010-06-18', null, 43, 293, 'alyviasteph8157', null, '2010-09-23', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Teach me how to do my homework', 'Looking for experienced doers.', '2010-04-08', null, '2010-06-14', null, 6, 360, 'alyviasteph8157', null, '2010-09-18', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Clean my houses', 'This task is not as hard as it seems.', '2010-05-17', null, '2010-06-20', null, 7, 154, 'alyviasteph8157', null, '2010-09-16', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Clean my table', 'Looking for experienced doers.', '2010-05-23', null, '2010-06-22', null, 43, 55, 'alyviasteph8157', null, '2010-09-30', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Collect my parcel', 'Need urgent help, please ping me.', '2010-05-03', null, '2010-06-24', null, 13, 443, 'allenbisho4523', null, '2010-08-07', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Assist me in Spring Cleaning', 'Need urgent help, please ping me.', '2010-05-09', null, '2010-06-05', null, 17, 347, 'allenbisho4523', null, '2010-08-28', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Water my lawn', 'I pay well and usually engage with task doers I like repeatedly', '2010-04-05', null, '2010-06-17', null, 25, 272, 'allenbisho4523', null, '2010-09-28', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Water my flowers', 'Assist me and will reward handsomely.', '2010-04-29', null, '2010-06-24', null, 20, 467, 'allenbisho4523', null, '2010-08-02', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Buy my groceries', 'Assist me and will reward handsomely.', '2010-05-25', null, '2010-06-25', null, 49, 434, 'allenbisho4523', null, '2010-08-09', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Carry large TV to my room', 'Help me and I will pay you well.', '2010-05-14', null, '2010-06-16', null, 15, 443, 'allenbisho4523', null, '2010-09-02', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash my curtains', 'Assist me and will reward handsomely.', '2010-05-01', null, '2010-06-03', null, 33, 127, 'allenbisho4523', null, '2010-08-17', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Carry a large TV to my room', 'I''m old, any kind souls please?', '2010-04-13', null, '2010-06-19', null, 36, 355, 'allenbisho4523', null, '2010-08-02', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash all my clothes', 'Want professional help', '2010-05-22', null, '2010-06-18', null, 40, 69, 'allenbisho4523', null, '2010-08-06', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Teach me how to do my homework', 'Am usually kind with strangers.', '2010-05-16', null, '2010-06-01', null, 43, 169, 'allenbisho4523', null, '2010-09-02', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Buy my groceries', 'Am usually kind with strangers.', '2010-04-11', null, '2010-06-08', null, 18, 275, 'khloevillar8727', null, '2010-08-03', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash my curtains', 'Please help!', '2010-04-11', null, '2010-06-04', null, 39, 431, 'khloevillar8727', null, '2010-09-19', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Fetch my nephew from school', 'Need urgent help, please ping me.', '2010-05-10', null, '2010-06-26', null, 41, 248, 'khloevillar8727', null, '2010-09-06', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash my bed sheets', 'Need someone who is responsible and well-trained.', '2010-04-23', null, '2010-06-08', null, 6, 359, 'khloevillar8727', null, '2010-09-23', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash my clothes', 'I pay well and usually engage with task doers I like repeatedly', '2010-05-10', null, '2010-06-19', null, 49, 292, 'khloevillar8727', null, '2010-09-29', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Wash all my clothes', 'Need urgent help, please ping me.', '2010-05-19', null, '2010-06-16', null, 43, 434, 'khloevillar8727', null, '2010-09-08', null, null);
INSERT INTO Task (title, description, created_at, updated_at, start_at, end_at, min_bid, max_bid, creator_username, assignee_username, completed_at, remarks, deleted_at) VALUES ('Feed my cat', 'Assist me and will reward handsomely.', '2010-04-30', null, '2010-06-05', null, 39, 434, 'khloevillar8727', null, '2010-08-31', null, null);

-- Pre-determined Categories
INSERT INTO Category (name, created_at) VALUES ('Minor Repairs', '2017-10-22');
INSERT INTO Category (name, created_at) VALUES ('Mounting', '2017-10-22');
INSERT INTO Category (name, created_at) VALUES ('Assembly', '2017-10-22');
INSERT INTO Category (name, created_at) VALUES ('Help Moving', '2017-10-22');
INSERT INTO Category (name, created_at) VALUES ('Delivery', '2017-10-22');
INSERT INTO Category (name, created_at) VALUES ('BabySitting', '2017-10-22');
INSERT INTO Category (name, created_at) VALUES ('Others', '2017-10-22');

insert into Months values ('1','January');
insert into Months values ('2','February');
insert into Months values ('3','March');
insert into Months values ('4','April');
insert into Months values ('5','May');
insert into Months values ('6','June');
insert into Months values ('7','July');
insert into Months values ('8','August');
insert into Months values ('9','September');
insert into Months values ('10','October');
insert into Months values ('11','November');
insert into Months values ('12','December');
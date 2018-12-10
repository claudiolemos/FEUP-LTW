DROP TRIGGER IF EXISTS InsertVoteOnPost;
DROP TRIGGER IF EXISTS RemoveVoteOnPost;
DROP TRIGGER IF EXISTS InsertVoteOnComment;
DROP TRIGGER IF EXISTS RemoveVoteOnComment;

DROP TABLE IF EXISTS Subscriptions;
DROP TABLE IF EXISTS VoteOnPost;
DROP TABLE IF EXISTS VoteOnComment;
DROP TABLE IF EXISTS Posts;
DROP TABLE IF EXISTS Comments;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Channels;

-- Tables

CREATE TABLE Users (
	id 							INTEGER PRIMARY KEY,
	username 				VARCHAR UNIQUE NOT NULL,
	email 					VARCHAR UNIQUE NOT NULL,
	password 				VARCHAR NOT NULL,
	cake_day 				INTEGER NOT NULL,
	karma 					INT NOT NULL
);

CREATE TABLE Channels (
	id 							INTEGER PRIMARY KEY,
	name 						VARCHAR UNIQUE NOT NULL,
	description 		VARCHAR NOT NULL,
	creation_day 		INTEGER NOT NULL
);

CREATE TABLE Posts (
	id 							INTEGER PRIMARY KEY,
	title 					VARCHAR NOT NULL,
	content 				VARCHAR,
	link 						VARCHAR,
	date 						INTEGER NOT NULL,
	user_id 				INT NOT NULL,
	channel_id 			INT NOT NULL,
	votes 					INT NOT NULL,
	FOREIGN KEY(user_id)	REFERENCES Users(id),
	FOREIGN KEY(channel_id)	REFERENCES Channels(id)
);

CREATE TABLE Comments (
	id 							INTEGER PRIMARY KEY,
	content 				VARCHAR,
	user_id 				INT NOT NULL,
	post_id 				INT NOT NULL,
	date				 		INTEGER NOT NULL,
	parent_id				INT,
	votes 					INT NOT NULL,
	FOREIGN KEY(parent_id)	REFERENCES Comments(id)
);

CREATE TABLE Subscriptions (
	user_id 				INT NOT NULL,
	channel_id 			INT NOT NULL,
	PRIMARY KEY(user_id, channel_id),
	FOREIGN KEY(user_id)	REFERENCES Users(id),
	FOREIGN KEY(channel_id)	REFERENCES Channels(id)
);

CREATE TABLE VoteOnPost (
	user_id 				INT NOT NULL,
	post_id 				INT NOT NULL,
	value						INT NOT NULL,
	FOREIGN KEY(user_id)	REFERENCES Users(id),
	FOREIGN KEY(post_id)	REFERENCES Posts(id)
);

CREATE TABLE VoteOnComment (
	user_id 				INT NOT NULL,
	comment_id 			INT NOT NULL,
	value						INT NOT NULL,
	FOREIGN KEY(user_id)	REFERENCES Users(id),
	FOREIGN KEY(comment_id)	REFERENCES Comments(id)
);

-- Triggers

CREATE TRIGGER InsertVoteOnPost
AFTER INSERT ON VoteOnPost
BEGIN
	DELETE FROM VoteOnPost WHERE user_id = NEW.user_id AND post_id = NEW.post_id AND value = NEW.value * -1;
	UPDATE Posts SET votes = votes + NEW.value WHERE Posts.id = NEW.post_id;
	UPDATE Users SET karma = karma + NEW.value WHERE Users.id = (SELECT user_id FROM Posts WHERE Posts.id = NEW.post_id);
END;

CREATE TRIGGER RemoveVoteOnPost
AFTER DELETE ON VoteOnPost
BEGIN
	UPDATE Posts SET votes = votes - OLD.value WHERE Posts.id = OLD.post_id;
	UPDATE Users SET karma = karma - OLD.value WHERE Users.id = (SELECT user_id FROM Posts WHERE Posts.id = OLD.post_id);
END;

CREATE TRIGGER InsertVoteOnComment
AFTER INSERT ON VoteOnComment
BEGIN
	DELETE FROM VoteOnComment WHERE user_id = NEW.user_id AND comment_id = NEW.comment_id AND value = NEW.value * -1;
	UPDATE Comments SET votes = votes + NEW.value WHERE Comments.id = NEW.comment_id;
	UPDATE Users SET karma = karma + NEW.value WHERE Users.id = (SELECT user_id FROM Comments WHERE Comments.id = NEW.comment_id);
END;

CREATE TRIGGER RemoveVoteOnComment
AFTER DELETE ON VoteOnComment
BEGIN
	UPDATE Comments SET votes = votes - OLD.value WHERE Comments.id = OLD.comment_id;
	UPDATE Users SET karma = karma - OLD.value WHERE Users.id = (SELECT user_id FROM Comments WHERE Comments.id = OLD.comment_id);
END;

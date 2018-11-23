DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Posts;
DROP TABLE IF EXISTS Channels;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Vote_Comment;
DROP TABLE IF EXISTS Vote_Post;
DROP TABLE IF EXISTS User_Channel_Membership;


CREATE TABLE Users (
					id INTEGER PRIMARY KEY,
					username VARCHAR NOT NULL,
					name VARCHAR NOT NULL,
					email VARCHAR NOT NULL,
					password VARCHAR NOT NULL,
					cakeday date NOT NULL
);

CREATE TABLE Posts (
					id INTEGER PRIMARY KEY,
					content VARCHAR NOT NULL,
					user_id integer NOT NULL,
					date date NOT NULL,
					title VARCHAR NOT NULL,
					link VARCHAR,
					channel_id INTEGER REFERENCES Channels

);

CREATE TABLE Channels (
					id INTEGER PRIMARY KEY,
			    name VARCHAR NOT NULL,
			    description VARCHAR NOT NULL
);

CREATE TABLE Comment (
			  	id INTEGER PRIMARY KEY,
					content VARCHAR NOT NULL,
					user_id integer NOT NULL,
					post_id integer NOT NULL,
					comment_date date NOT NULL,
					parent_Comment integer
);

CREATE TABLE User_Channel_Membership (
						user_id INTEGER REFERENCES Users,
					  channel_id INTEGER REFERENCES Channels
);


CREATE TABLE Vote_Comment (
							 user_id INTEGER REFERENCES Users,
						   comment_id INTEGER REFERENCES Comment,
						   value integer NOT NULL
);

CREATE TABLE Vote_Post (
						user_id INTEGER REFERENCES Users,
						post_id integer REFERENCES Posts,
						value integer NOT NULL
);

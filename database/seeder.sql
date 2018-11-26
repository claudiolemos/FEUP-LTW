PRAGMA foreign_keys=ON;

-- Users:

INSERT INTO Users VALUES (
  NULL, -- 1
  "duarte",
  "Duarte Faria",
  "duartefaria97@gmail.com",
  "827ccb0eea8a706c4c34a16891f84e7b", -- md5 encryption of 12345
  "03-08-2018"
);

INSERT INTO Users VALUES (
  NULL, -- 2
  "claudio",
  "Claudio Lemos",
  "claudio@gmail.com",
  "827ccb0eea8a706c4c34a16891f84e7b", -- md5 encryption of 12345
  "25-09-2018"
);

INSERT INTO Users VALUES (
  NULL, -- 3
  "ze",
  "Jose Mendes",
  "ze@gmail.com",
  "827ccb0eea8a706c4c34a16891f84e7b",  -- md5 encryption of 12345
  "03-10-2018"
);

-- Channels:

INSERT INTO Channels VALUES (
  NULL, -- 1
  "movies",
  "Find the latest news on movies and discuss everything about the seventh art here",
  "01-01-2018"
);

INSERT INTO Channels VALUES (
  NULL, -- 2
  "music",
  "The musical community",
  "01-01-2018"
);

INSERT INTO Channels VALUES (
  NULL, -- 3
  "sports",
  "The central hub for sports",
  "01-01-2018"
);

INSERT INTO Channels VALUES (
  NULL, -- 4
  "gaming",
  "Anything related to games",
  "01-01-2018"
);

INSERT INTO Channels VALUES (
  NULL, -- 5
  "news",
  "News from around the world",
  "01-01-2018"
);

-- Posts:

INSERT INTO Posts VALUES (
  NULL, -- 1
  "My first post",
  "Hello everyone! Can't wait to talk about cinema with you guys",
  NULL,
  "23-11-2018",
  1, -- duarte
  1  -- movies
);

INSERT INTO Posts VALUES (
  NULL, -- 2
  "My first post",
  "Hello everyone! Can't wait to talk about music with you guys",
  NULL,
  "26-11-2018",
  2, -- claudio
  2  -- music
);

INSERT INTO Posts VALUES (
  NULL, -- 3
  "My first post",
  "Hello everyone! Can't wait to talk about sports with you guys",
  NULL,
  "25-11-2018",
  3, -- ze
  3  -- sports
);

INSERT INTO Posts VALUES (
  NULL, -- 4
  "My second post",
  "Hope to see you next sunday at the game",
  NULL,
  "26-11-2018",
  3, -- ze
  3  -- sports
);

-- Comments:

INSERT INTO Comments VALUES (
  NULL, -- 1
  "Claudio's first commment",
  2, -- claudio
  3, -- post_id
  "01-12-2018",
  NULL -- no parent comment
);

INSERT INTO Comments VALUES (
  NULL, -- 2
  "Ze's reply to Claudio's commment",
  3, -- ze
  3, -- post_id
  "01-12-2018",
  1 -- parent comment
);

INSERT INTO Comments VALUES (
  NULL, -- 3
  "Duarte's reply to Ze's reply to Claudio's commment",
  1, -- duarte
  3, -- post_id
  "03-12-2018",
  2 -- parent comment
);

INSERT INTO Comments VALUES (
  NULL, -- 4
  "What's your favorite movie?",
  3, -- ze
  1, -- post_id
  "03-12-2018",
  NULL -- no parent comment
);

-- Subscriptions:

INSERT INTO Subscriptions VALUES (1,2); -- duarte is subscribed to music
INSERT INTO Subscriptions VALUES (1,3); -- duarte is subscribed to sports
INSERT INTO Subscriptions VALUES (2,1); -- claudio is subscribed to movies
INSERT INTO Subscriptions VALUES (2,2); -- claudio is subscribed to music
INSERT INTO Subscriptions VALUES (3,3); -- claudio is subscribed to sports
INSERT INTO Subscriptions VALUES (3,4); -- claudio is subscribed to gaming
INSERT INTO Subscriptions VALUES (3,5); -- claudio is subscribed to news

-- VoteOnPost:

INSERT INTO VoteOnPost VALUES (1,1,1);  -- duarte upvoted post 1 by duarte
INSERT INTO VoteOnPost VALUES (1,2,1);  -- duarte upvoted post 2 by claudio
INSERT INTO VoteOnPost VALUES (1,3,-1); -- duarte downvoted post 3 by ze
INSERT INTO VoteOnPost VALUES (2,1,-1); -- claudio downvoted post 1 by duarte
INSERT INTO VoteOnPost VALUES (2,2,1);  -- claudio upvoted post 2 by claudio
INSERT INTO VoteOnPost VALUES (2,3,-1); -- claudio downvoted post 3 by ze
INSERT INTO VoteOnPost VALUES (3,1,1);  -- ze upvoted post 1 by duarte
INSERT INTO VoteOnPost VALUES (3,2,1);  -- ze upvoted post 2 by claudio
INSERT INTO VoteOnPost VALUES (3,3,1);  -- ze upvoted post 3 by ze
INSERT INTO VoteOnPost VALUES (3,4,1);  -- ze upvoted post 4 by ze


-- VoteOnComment:

INSERT INTO VoteOnComment VALUES (2,1,1);  -- claudio upvoted comment 1 by claudio
INSERT INTO VoteOnComment VALUES (3,2,1);  -- ze upvoted comment 2 by ze
INSERT INTO VoteOnComment VALUES (1,3,1);  -- duarte upvoted comment 3 by duarte
INSERT INTO VoteOnComment VALUES (3,4,1);  -- ze upvoted comment 4 by ze

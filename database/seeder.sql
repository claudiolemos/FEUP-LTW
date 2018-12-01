-- Users:

INSERT INTO Users VALUES (
  NULL, -- 1
  "duarte",
  "Duarte Faria",
  "duartefaria97@gmail.com",
  "03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4", -- sha256 encryption of 12345
  "2018-08-03",
  0
);

INSERT INTO Users VALUES (
  NULL, -- 2
  "claudio",
  "Claudio Lemos",
  "claudio@gmail.com",
  "03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4", -- sha256 encryption of 12345
  "2018-09-25",
  0
);

INSERT INTO Users VALUES (
  NULL, -- 3
  "ze",
  "Jose Mendes",
  "ze@gmail.com",
  "03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4",  -- sha256 encryption of 12345
  "2018-10-03",
  0
);

-- Channels:

INSERT INTO Channels VALUES (
  NULL, -- 1
  "movies",
  "Find the latest news on movies and discuss everything about the seventh art here",
  "2018-01-01"
);

INSERT INTO Channels VALUES (
  NULL, -- 2
  "music",
  "The musical community",
  "2018-01-01"
);

INSERT INTO Channels VALUES (
  NULL, -- 3
  "sports",
  "The central hub for sports",
  "2018-01-01"
);

INSERT INTO Channels VALUES (
  NULL, -- 4
  "gaming",
  "Anything related to games",
  "2018-01-01"
);

INSERT INTO Channels VALUES (
  NULL, -- 5
  "news",
  "News from around the world",
  "2018-01-01"
);

-- Posts:

INSERT INTO Posts VALUES (
  NULL, -- 1
  "My first post",
  "Hello everyone! Can't wait to talk about cinema with you guys",
  NULL,
  "2018-11-23",
  1, -- duarte
  1, -- movies
  0
);

INSERT INTO Posts VALUES (
  NULL, -- 2
  "My first post",
  "Hello everyone! Can't wait to talk about music with you guys",
  NULL,
  "2018-11-26",
  2, -- claudio
  2, -- music
  0
);

INSERT INTO Posts VALUES (
  NULL, -- 3
  "My first post",
  "Hello everyone! Can't wait to talk about sports with you guys",
  NULL,
  "2018-11-25",
  3, -- ze
  3, -- sports
  0
);

INSERT INTO Posts VALUES (
  NULL, -- 4
  "My second post",
  "Hope to see you next sunday at the game",
  NULL,
  "2018-11-26",
  3, -- ze
  3, -- sports
  0
);

-- Comments:

INSERT INTO Comments VALUES (
  NULL, -- 1
  "Claudio's first commment",
  2, -- claudio
  3, -- post_id
  "2018-12-01",
  NULL, -- no parent comment
  0
);

INSERT INTO Comments VALUES (
  NULL, -- 2
  "Ze's reply to Claudio's commment",
  3, -- ze
  3, -- post_id
  "2018-12-01",
  1, -- parent comment
  0
);

INSERT INTO Comments VALUES (
  NULL, -- 3
  "Duarte's reply to Ze's reply to Claudio's commment",
  1, -- duarte
  3, -- post_id
  "2018-12-03",
  2, -- parent comment
  0
);

INSERT INTO Comments VALUES (
  NULL, -- 4
  "What's your favorite movie?",
  3, -- ze
  1, -- post_id
  "2018-12-03",
  NULL, -- no parent comment
  0
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

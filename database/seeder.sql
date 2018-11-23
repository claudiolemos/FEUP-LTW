INSERT INTO Channels VALUES (NULL,
  "movies",
  "Find the latest news on movies and discuss everything about the seventh art here").

INSERT INTO Channels VALUES ( NULL,
  "music",
  "The musical community of ______");

INSERT INTO Channels VALUES ( NULL,
  "sports",
  "The central hub for sports on ______");

INSERT INTO Channels VALUES ( NULL,
  "gaming",
  "Anything related to games - video games, board games, card games, etc.");

INSERT INTO Channels VALUES ( NULL,
  "news",
  "News from around the world");

INSERT INTO Users VALUES (NULL,
  "duarte",
  "Duarte Faria",
  "duartefaria97@gmail.com",
  "827ccb0eea8a706c4c34a16891f84e7b", -- md5 encryption of 12345
  "12-12-2018"
);

INSERT INTO Users VALUES (NULL,
  "claudio",
  "Claudio Lemos",
  "claudio@gmail.com",
  "827ccb0eea8a706c4c34a16891f84e7b", -- md5 encryption of 12345
  "01-01-201"
);

INSERT INTO Users VALUES (NULL,
  "ze",
  "Jose Mendes",
  "ze@gmail.com",
  "827ccb0eea8a706c4c34a16891f84e7b",
  "01-01-1999"
);

INSERT INTO Posts (NULL,
  "Ola a todos os membros deste channel!",
  "1",
  "23-11-2018",
  "O meu primeiro post!",
  NULL,
  "1"
);

INSERT INTO Posts (NULL,
  "Corpo do meu post",
  "2",
  "24-11-2018",
  "Titulo do meu post",
  NULL,
  "2"
);

INSERT INTO Posts (NULL,
  "Link para uma noticia",
  "3",
  "25-11-2018",
  "Titulo do meu post",
  NULL,
  "2"
);

INSERT INTO Comment ( NULL,
  "Meu primeiro comment!",
  "2", --User de id = 2
  "1", -- Post de id = 1
  "25-12-2018",
  NULL -- Sem parent comment_
);

INSERT INTO Comment ( NULL,
  "Comentario do Comentario",
  "1", -- User de id = 1
  "1", -- Post de id = 1
  "25-12-2018",
  "1"  --comentario aocomment de id = 1
);

INSERT INTO Comment ( NULL,
  "Mais 1 comentario",
  "3", -- User de id = 3
  "2", -- Post de id = 2
  "25-12-2018",
  NULL -- Sem parent comment_
);

INSERT INTO Comment ( NULL,
  "Ganda Som!",
  "2", -- User de id = 2
  "1", -- Post de id = 1
  "25-12-2018",
  "2" --comentario ao comment de id = 2
);

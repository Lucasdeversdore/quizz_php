DROP TABLE IF EXISTS SCORE;

VACUUM; -- Nettoie la base de données et enlève les tables obsolètes

CREATE TABLE SCORE (
    idJ INTEGER PRIMARY KEY,
    nomJ TEXT NOT NULL,
    score INTEGER
);



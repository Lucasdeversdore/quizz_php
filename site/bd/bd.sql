drop table REPONSE;
drop table QUESTIONS;
drop table QUIZZ;

create table QUIZZ (
    idQuizz INTEGER NOT NULL,
    nomQuizz TEXT NOT NULL,
    PRIMARY KEY (idQuizz)
);

create table QUESTIONS (
    idQuestion INTEGER NOT NULL,
    titreQuestion TEXT NOT NULL,
    idQuizz INTEGER NOT NULL,
    PRIMARY KEY (idQuestion),
    FOREIGN KEY (idQuizz) REFERENCES QUIZZ (idQuizz)
);

create table REPONSE (
    idReponse INTEGER NOT NULL,
    titreReponse TEXT NOT NULL,
    bonneReponse BOOLEAN NOT NULL,
    idQuestion INTEGER NOT NULL,
    PRIMARY KEY(idReponse),
    FOREIGN KEY (idQuestion) REFERENCES QUESTIONS (idQuestion)
);


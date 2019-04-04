create database SWIIP_USER_MANAGMENT

/*==============================================================*/
/* Table: USERS                                                 */
/*==============================================================*/
create table USERS 
(
   U_MAIL               varchar(50)                    not null,
   PASSWORD             varchar(250)                   not null,
   USERNAME             varchar(25)                    not null,
   F_NAME               varchar(20)                    not null,
   L_NAME               varchar(20)                    not null,
   AGE                  int                            not null,
   GENDER               varchar(10)                    null,
   F_O_I_1              varchar(30)                    null,
   F_O_I_2              varchar(30)                    null,
   F_O_I_3              varchar(30)                    null,
   F_O_I_4              varchar(30)                    null,
   F_O_I_5              varchar(30)                    null,
    primary key (U_MAIL)
);

/*==============================================================*/
/* Table: COMPANIES                                             */
/*==============================================================*/
create table COMPANIES 
(
   C_MAIL               varchar(50)                    not null,
   C_PASSWORD           varchar(250)                   not null,
   NAME                 varchar(50)                    not null,
   F_O_I_1              varchar(30)                    null,
   F_O_I_2              varchar(30)                    null,
   F_O_I_3              varchar(30)                    null,
   F_O_I_4              varchar(30)                    null,
   F_O_I_5              varchar(30)                    null,
    primary key (C_MAIL)
);

/*==============================================================*/
/* Table: VACANCIES                                             */
/*==============================================================*/
create table VACANCIES 
(
   V_ID                 int                            not null AUTO_INCREMENT,
   C_MAIL               varchar(50)                    not null,
   TITLE                varchar(50)                    not null,
   DESCRIPTION          varchar(300)                   not null,
   REQUIRMENTS          varchar(200)                   null,
   BENIFITS             varchar(100)                   null,
   SALARY               double                         null,
   TYPE                 varchar(30)                    null,
    primary key (V_ID),
    FOREIGN KEY (C_MAIL) REFERENCES COMPANIES(C_MAIL) ON DELETE CASCADE
);

/*==============================================================*/
/* Table: APPLICATION_FORM                                       */
/*==============================================================*/
create table APPLICATION_FORM 
(
   V_ID                 int                            not null,
   Q                    varchar(100)                   not null,
    primary key (V_ID, Q),
    FOREIGN KEY (V_ID) REFERENCES VACANCIES(V_ID) ON DELETE CASCADE
);

/*==============================================================*/
/* Table: CANDIDATES_FORM                                       */
/*==============================================================*/
create table CANDIDATES_FORM 
(
   V_ID                 int                            not null,
   U_MAIL               varchar(50)                    not null,
   A                    varchar(100)                   not null,
    primary key (V_ID, U_MAIL, A),
    FOREIGN KEY (V_ID) REFERENCES VACANCIES(V_ID) ON DELETE CASCADE
);


/*==============================================================*/
/* Table: FOLLOEWED_COMPANIES                                   */
/*==============================================================*/
create table FOLLOEWED_COMPANIES 
(
   U_MAIL               varchar(50)                    not null,
   F_MAIL               varchar(50)                    not null,
   primary key (U_MAIL,F_MAIL),
    FOREIGN KEY (U_MAIL) REFERENCES USERS(U_MAIL) ON DELETE CASCADE,
    FOREIGN KEY (F_MAIL) REFERENCES USERS(U_MAIL) ON DELETE CASCADE
);

/*==============================================================*/
/* Table: FOLLOWED_USERS                                        */
/*==============================================================*/
create table FOLLOWED_USERS 
(
   U_MAIL               varchar(50)                    not null,
   F_MAIL               varchar(50)                    not null,
    primary key (U_MAIL, F_MAIL),
    FOREIGN KEY (U_MAIL) REFERENCES USERS(U_MAIL) ON DELETE CASCADE,
    FOREIGN KEY (F_MAIL) REFERENCES USERS(U_MAIL) ON DELETE CASCADE
);

/*==============================================================*/
/* Table: POSTS                                                 */
/*==============================================================*/
create table POSTS 
(
   P_ID                 int                            not null AUTO_INCREMENT,
   U_MAIL               varchar(50)                    not null,
   P_TEXT                 varchar(500)                   not null,
   PRIVACY              varchar(20)                    not null,
   VOTE                 int                            null,
    primary key (P_ID),
    FOREIGN KEY (U_MAIL) REFERENCES USERS(U_MAIL) ON DELETE CASCADE
);

/*==============================================================*/
/* Table: P_REPLIES                                             */
/*==============================================================*/
create table P_REPLIES 
(
   P_ID                 int                            not null,
   U_MAIL               varchar(50)                    not null,
   R_Text                 varchar(100)                   not null,
    primary key (P_ID, U_MAIL, R_TEXT),
    FOREIGN KEY (U_MAIL) REFERENCES USERS(U_MAIL) ON DELETE CASCADE,
    FOREIGN KEY (P_ID) REFERENCES POSTS(P_ID) ON DELETE CASCADE
);

/*==============================================================*/
/* Table: QUIZEZ_RESOLVED                                       */
/*==============================================================*/
create table QUIZEZ_RESOLVED 
(
   U_MAIL               varchar(50)                     not null,
   Q_ID                 int                            not null,
   primary key (U_MAIL,Q_ID),
    FOREIGN KEY (U_MAIL) REFERENCES USERS(U_MAIL) ON DELETE CASCADE
);


/*==============================================================*/
/* Table: U_SKILLS                                              */
/*==============================================================*/
create table U_SKILLS 
(
   U_MAIL               varchar(50)                     not null,
   SKILL                varchar(40)                    not null,
   SCORE                int                            not null,
    primary key (U_MAIL, SKILL),
    FOREIGN KEY (U_MAIL) REFERENCES USERS(U_MAIL) ON DELETE CASCADE
);


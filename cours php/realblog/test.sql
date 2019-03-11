create table T_CHAMBRE
(
    CHB_ID               INTEGER                not null,
    CHB_NUMERO           SMALLINT               not null,
    CHB_ETAGE            CHAR(3)                null    ,
    CHB_BAIN             NUMERIC(1)              default 0 not null,
    CHB_DOUCHE           NUMERIC(1)              default 1 not null,
    CHB_WC               NUMERIC(1)              default 1 not null,
    CHB_COUCHAGE         SMALLINT               not null,
    CHB_POSTE_TEL        CHAR(3)                null    ,
    constraint PK_T_CHAMBRE primary key (CHB_ID)
);
                               
create table T_TARIF
(
    TRF_DATE_DEBUT       DATE                   not null,
    TRF_TAUX_TAXES       NUMERIC                 not null,
    TRF_PETIT_DEJEUNE    NUMERIC(8,2)            not null,
    constraint PK_T_TARIF primary key (TRF_DATE_DEBUT)
);

create table T_PLANNING
(
    PLN_JOUR             DATE                   not null,
    constraint PK_T_PLANNING primary key (PLN_JOUR)
);

create table T_TITRE
(
    TIT_CODE             CHAR(8)                not null,
    TIT_LIBELLE          VARCHAR(32)           not null,
    constraint PK_T_TITRE primary key (TIT_CODE)
);

create table T_TYPE
(
    TYP_CODE             CHAR(8)                not null,
    TYP_LIBELLE          VARCHAR(32)           not null,
    constraint PK_T_TYPE primary key (TYP_CODE)
);

create table T_MODE_PAIEMENT
(
    PMT_CODE             CHAR(8)                not null,
    PMT_LIBELLE          VARCHAR(64)           not null,
    constraint PK_T_MODE_PAIEMENT primary key (PMT_CODE)
);

create table T_CLIENT
(
    CLI_ID               INTEGER                not null,
    TIT_CODE             CHAR(8)                null    ,
    CLI_NOM              CHAR(32)               not null,
    CLI_PRENOM           VARCHAR(25)           null    ,
    CLI_ENSEIGNE         VARCHAR(100)          null    ,
    constraint PK_T_CLIENT primary key (CLI_ID)
);

create index L_CLI_TIT_FK on T_CLIENT (TIT_CODE asc);

create table T_FACTURE
(
    FAC_ID               INTEGER                not null,
    CLI_ID               INTEGER                not null,
    PMT_CODE             CHAR(8)                null    ,
    FAC_DATE             DATE                   not null,
    FAC_PMT_DATE         DATE                   null    ,
    constraint PK_T_FACTURE primary key (FAC_ID)
);

create index L_FAC_CLI_FK on T_FACTURE (CLI_ID asc);

create index TJ_FAC_PMT_FK on T_FACTURE (PMT_CODE asc);

create table T_ADRESSE
(
    ADR_ID               INTEGER                not null,
    CLI_ID               INTEGER                not null,
    ADR_LIGNE1           VARCHAR(32)           not null,
    ADR_LIGNE2           VARCHAR(32)           null    ,
    ADR_LIGNE3           VARCHAR(32)           null    ,
    ADR_LIGNE4           VARCHAR(32)           null    ,
    ADR_CP               CHAR(5)                not null,
    ADR_VILLE            CHAR(32)               not null,
    constraint PK_T_ADRESSE primary key (ADR_ID)
);

create index L_ADR_CLI_FK on T_ADRESSE (CLI_ID asc);

create table T_TELEPHONE
(
    TEL_ID               INTEGER                not null,
    CLI_ID               INTEGER                not null,
    TYP_CODE             CHAR(8)                not null,
    TEL_NUMERO           CHAR(20)               not null,
    TEL_LOCALISATION     VARCHAR(64)           null    ,
    constraint PK_T_TELEPHONE primary key (TEL_ID)
);

create index L_TEL_CLI_FK on T_TELEPHONE (CLI_ID asc);

create index L_TEL_TYP_FK on T_TELEPHONE (TYP_CODE asc);

create table T_EMAIL
(
    EML_ID               INTEGER                not null,
    CLI_ID               INTEGER                not null,
    EML_ADRESSE          VARCHAR(100)          not null,
    EML_LOCALISATION     VARCHAR(64)           null    ,
    constraint PK_T_EMAIL primary key (EML_ID)
);

create index L_EML_CLI_FK on T_EMAIL (CLI_ID asc);

create table T_LIGNE_FACTURE
(
    LIF_ID               INTEGER                not null,
    FAC_ID               INTEGER                not null,
    LIF_QTE              NUMERIC                 not null,
    LIF_REMISE_POURCENT  NUMERIC                 default 0  not null,
    LIF_REMISE_MONTANT   NUMERIC(8,2)            default 0  not null,
    LIF_MONTANT          NUMERIC(8,2)            not null,
    LIF_TAUX_TVA         NUMERIC                 not null,
    constraint PK_T_LIGNE_FACTURE primary key (LIF_ID)
);

create index L_LIF_FAC_FK on T_LIGNE_FACTURE (FAC_ID asc);

create table TJ_TRF_CHB
(
    CHB_ID               INTEGER                not null,
    TRF_DATE_DEBUT       DATE                   not null,
    TRF_CHB_PRIX         NUMERIC(8,2)            not null,
    constraint PK_TJ_TRF_CHB primary key (CHB_ID, TRF_DATE_DEBUT)
);

create index L_CHB_TRF_FK on TJ_TRF_CHB (CHB_ID asc);

create index L_TRF_CHB_FK on TJ_TRF_CHB (TRF_DATE_DEBUT asc);

create table TJ_CHB_PLN_CLI
(
    CHB_ID               INTEGER                not null,
    PLN_JOUR             DATE                   not null,
    CLI_ID               INTEGER                not null,
    CHB_PLN_CLI_NB_PERS  SMALLINT               not null,
    CHB_PLN_CLI_RESERVE  NUMERIC(1)              default 0 not null,
    CHB_PLN_CLI_OCCUPE   NUMERIC(1)              default 1 not null,
    constraint PK_TJ_CHB_PLN_CLI primary key (CHB_ID, PLN_JOUR)
);

create index L_CHB_PLN_CLI_FK on TJ_CHB_PLN_CLI (CHB_ID asc);

create index L_PLN_CHB_CLI_FK on TJ_CHB_PLN_CLI (PLN_JOUR asc);

create index L_CLI_CHB_PLN_FK on TJ_CHB_PLN_CLI (CLI_ID asc);


alter table T_CLIENT
    add constraint FK_T_CLIENT_L_CLI_TIT_T_TITRE foreign key  (TIT_CODE)
       references T_TITRE (TIT_CODE);

alter table T_FACTURE
    add constraint FK_T_FACTUR_L_FAC_CLI_T_CLIENT foreign key  (CLI_ID)
       references T_CLIENT (CLI_ID);

alter table T_FACTURE
    add constraint FK_T_FACTUR_TJ_FAC_PM_T_MODE_P foreign key  (PMT_CODE)
       references T_MODE_PAIEMENT (PMT_CODE);

alter table T_ADRESSE
    add constraint FK_T_ADRESS_L_ADR_CLI_T_CLIENT foreign key  (CLI_ID)
       references T_CLIENT (CLI_ID);

alter table T_TELEPHONE
    add constraint FK_T_TELEPH_L_TEL_CLI_T_CLIENT foreign key  (CLI_ID)
       references T_CLIENT (CLI_ID);

alter table T_TELEPHONE
    add constraint FK_T_TELEPH_L_TEL_TYP_T_TYPE foreign key  (TYP_CODE)
       references T_TYPE (TYP_CODE);

alter table T_EMAIL
    add constraint FK_T_EMAIL_L_EML_CLI_T_CLIENT foreign key  (CLI_ID)
       references T_CLIENT (CLI_ID);

alter table T_LIGNE_FACTURE
    add constraint FK_T_LIGNE__L_LIF_FAC_T_FACTUR foreign key  (FAC_ID)
       references T_FACTURE (FAC_ID);

alter table TJ_TRF_CHB
    add constraint FK_TJ_TRF_C_L_CHB_TRF_T_CHAMBR foreign key  (CHB_ID)
       references T_CHAMBRE (CHB_ID);

alter table TJ_TRF_CHB
    add constraint FK_TJ_TRF_C_L_TRF_CHB_T_TARIF foreign key  (TRF_DATE_DEBUT)
       references T_TARIF (TRF_DATE_DEBUT);

alter table TJ_CHB_PLN_CLI
    add constraint FK_TJ_CHB_P_L_CHB_PLN_T_CHAMBR foreign key  (CHB_ID)
       references T_CHAMBRE (CHB_ID);

alter table TJ_CHB_PLN_CLI
    add constraint FK_TJ_CHB_P_L_PLN_CHB_T_PLANNI foreign key  (PLN_JOUR)
       references T_PLANNING (PLN_JOUR);

alter table TJ_CHB_PLN_CLI
    add constraint FK_TJ_CHB_P_L_CLI_CHB_T_CLIENT foreign key  (CLI_ID)
       references T_CLIENT (CLI_ID);
drop database if exists gestion_stock;
drop role if exists gestion_stock;
Create database gestion_stock;
Create role gestion_stock LOGIN password 'gestion_stock';
alter database gestion_stock owner to gestion_stock;
\c gestion_stock gestion_stock

CREATE SEQUENCE "public".demande START WITH 1 INCREMENT BY 1;

CREATE SEQUENCE "public".id_article START WITH 1 INCREMENT BY 1;

CREATE SEQUENCE "public".id_bc START WITH 1 INCREMENT BY 1;

CREATE SEQUENCE "public".id_br START WITH 1 INCREMENT BY 1;

CREATE SEQUENCE "public".id_dem_article START WITH 1 INCREMENT BY 1;

CREATE SEQUENCE "public".id_fournisseur START WITH 1 INCREMENT BY 1;

CREATE SEQUENCE "public".id_proforma START WITH 1 INCREMENT BY 1;

CREATE  TABLE "public".demande_achat ( 
	num_demande          integer DEFAULT nextval('demande'::regclass) NOT NULL  ,
	date_demande         date DEFAULT CURRENT_DATE NOT NULL  ,
	departement          varchar(30)  NOT NULL  ,
	CONSTRAINT pk_demande PRIMARY KEY ( num_demande )
 );

CREATE  TABLE "public".demande_article ( 
	id_dem_article       integer DEFAULT nextval('id_dem_article'::regclass) NOT NULL  ,
	nom                  varchar(30)  NOT NULL  ,
	quantite             integer DEFAULT 1 NOT NULL  ,
	demande              integer  NOT NULL  ,
	CONSTRAINT pk_demande_article PRIMARY KEY ( id_dem_article )
 );

CREATE  TABLE "public".fournisseur ( 
	id_fournisseur       integer DEFAULT nextval('id_fournisseur'::regclass) NOT NULL  ,
	nom_fournisseur      varchar(30)  NOT NULL  ,
	CONSTRAINT pk_fournisseur PRIMARY KEY ( id_fournisseur )
 );

CREATE  TABLE "public".article ( 
	id_article           integer DEFAULT nextval('id_article'::regclass) NOT NULL  ,
	nom_article          varchar(30)  NOT NULL  ,
	quantite             integer  NOT NULL  ,
	prix                 float DEFAULT 0 NOT NULL  ,
	fournisseur          integer  NOT NULL  ,
	qualite              varchar(30)  NOT NULL  ,
	CONSTRAINT pk_article PRIMARY KEY ( id_article )
 );

CREATE  TABLE "public".notes ( 
	article              integer  NOT NULL  ,
	note_quantite        float DEFAULT 0 NOT NULL  ,
	note_qualite         float DEFAULT 0 NOT NULL  ,
	note_prix            float DEFAULT 0 NOT NULL  
 );

CREATE  TABLE "public".proforma ( 
	id_proforma          integer DEFAULT nextval('id_proforma'::regclass) NOT NULL  ,
	article              integer  NOT NULL  ,
	delai                integer    ,
	lieu                 varchar(30)    ,
  Id_demande  int REFERENCES demande_achat (num_demande),
	CONSTRAINT pk_proforma PRIMARY KEY ( id_proforma )
 );

CREATE  TABLE "public".bon_commande ( 
	id_bc                integer DEFAULT nextval('id_bc'::regclass) NOT NULL  ,
	date_bc              date DEFAULT CURRENT_DATE NOT NULL  ,
	proforma             integer  NOT NULL  ,
	frais                integer DEFAULT 0 NOT NULL  ,
	tva                  float NOT NULL  ,
	CONSTRAINT pk_bon_commande PRIMARY KEY ( id_bc )
 );
 CREATE TABLE reception(
  id_reception serial PRIMARY KEY,
  id_bc int REFERENCES bon_commande(id_bc)
 );
  CREATE TABLE livraison(
  id_livraison serial PRIMARY KEY,
  id_bc int REFERENCES bon_commande(id_bc)
 );
ALTER TABLE "public".article ADD CONSTRAINT fk_article_fournisseur FOREIGN KEY ( fournisseur ) REFERENCES "public".fournisseur( id_fournisseur ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE "public".bon_commande ADD CONSTRAINT fk_bon_commande_proforma FOREIGN KEY ( proforma ) REFERENCES "public".proforma( id_proforma ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE "public".demande_article ADD CONSTRAINT fk_demande_article FOREIGN KEY ( demande ) REFERENCES "public".demande_achat( num_demande ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE "public".notes ADD CONSTRAINT fk_notes_article FOREIGN KEY ( article ) REFERENCES "public".article( id_article ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE "public".proforma ADD CONSTRAINT fk_proforma_article FOREIGN KEY ( article ) REFERENCES "public".article( id_article ) ON DELETE CASCADE ON UPDATE CASCADE;

CREATE VIEW "public".v_bc AS  SELECT bon_commande.id_bc,
    bon_commande.date_bc,
    proforma.id_proforma,
    proforma.Id_demande,
    fournisseur.id_fournisseur,
    article.id_article,
    article.nom_article AS designation,
    article.quantite,
    article.prix AS prix_unitaire,
    sum(((article.quantite)::numeric * article.prix)) AS montant_ht,
    bon_commande.tva,
    sum((((article.quantite)::numeric * article.prix) * bon_commande.tva)) AS montant_tva,
    (sum((((article.quantite)::numeric * article.prix) * bon_commande.tva)) + sum(((article.quantite)::numeric * article.prix))) AS montant_ttc,
    bon_commande.frais AS frais_livraison,
    ((sum((((article.quantite)::numeric * article.prix) * bon_commande.tva)) + sum(((article.quantite)::numeric * article.prix))) + (bon_commande.frais)::numeric) AS montant_total
   FROM ((bon_commande
     JOIN proforma ON ((bon_commande.proforma = proforma.id_proforma)))
     JOIN article ON ((proforma.article = article.id_article))
     JOIN fournisseur on ((article.fournisseur=fournisseur.id_fournisseur)))
  GROUP BY bon_commande.id_bc, proforma.id_proforma,  fournisseur.id_fournisseur,article.id_article,proforma.Id_demande;


select * from v_bc where Id_demande=1 and fournisseur=1;
CREATE VIEW "public".v_demande AS  SELECT demande_achat.num_demande,
    demande_achat.num_demande AS numero,
    demande_achat.departement,
    demande_article.id_dem_article,
    demande_article.nom AS article,
    demande_article.quantite,
    demande_achat.date_demande
   FROM (demande_article
     JOIN demande_achat ON ((demande_article.demande = demande_achat.num_demande)));

CREATE VIEW "public".v_demande_total AS  SELECT nom AS article,
    sum(quantite) AS quantite
   FROM demande_article
  GROUP BY nom;

CREATE VIEW "public".v_notes AS  SELECT fournisseur.nom_fournisseur,
    article.id_article,
    article.nom_article,
    notes.note_quantite,
    notes.note_qualite,
    notes.note_prix
   FROM ((notes
     JOIN article ON ((notes.article = article.id_article)))
     JOIN fournisseur ON ((article.fournisseur = fournisseur.id_fournisseur)));

CREATE VIEW "public".v_proforma AS  SELECT article.id_article,
    article.nom_article AS designation,
    article.quantite,
    article.prix,
    article.qualite,
    proforma.id_proforma,
    proforma.delai,
    proforma.lieu
   FROM (article
     JOIN proforma ON ((proforma.article = article.id_article)));

Create or replace view Bon_Commandes AS SELECT * from bon_commande;

Create or replace view vrai_proforma as
select proforma.id_proforma,article.nom_article,proforma.delai,proforma.lieu,proforma.Id_demande,article.fournisseur
from proforma join article on proforma.article=article.id_article;

Create or replace view commande_non_recu as
select * from v_bc where id_bc not in (select id_bc from reception) and id_bc in(select id_bc from livraison);

 select * from vrai_proforma where id_demande=1 and fournisseur=1;
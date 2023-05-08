insert into "public".fournisseur (nom_fournisseur) values
    ('Fournisseur1'),
    ('Fournisseur2'),
    ('Fournisseur3')
;

insert into "public".demande_achat (date_demande, departement) values
    ('2022-10-29', 'departement1'),
    ('2022-11-01', 'departement2')
;

insert into "public".demande_achat (departement) values
    ('departement1')
;

insert into "public".demande_article (nom, quantite, demande) values
    ('t_shirt', 3, 1),
    ('pantalon', 3, 1),
    ('bottes', 3, 1),
    ('t_shirt', 2, 2),
    ('jupe', 2, 2),
    ('casquette', 3, 3)
;

insert into "public".article (nom_article, quantite, prix, fournisseur, qualite) values
    ('blousons', 5, 30000, 1, 'cuir'),
    ('blousons', 5, 25000, 2, 'cuir'),
    ('blousons', 5, 20000, 3, 'faux cuir')
;
insert into "public".article (nom_article, quantite, prix, fournisseur, qualite) values
    ('souris', 15, 15000, 1, 'vrai'),
    ('stylos', 45, 4500, 1, 'vrai'),
    ('stylo', 10, 3500, 3, 'faux ')
;

insert into "public".proforma (article, delai, lieu) values
    (1, 14, 'Antananarivo'),
    (2, 14, 'Antananarivo'),
    (3, 14, 'Antananarivo')
;

insert into "public".proforma (article, delai, lieu,id_demande) values
    (4, 12, 'Adoaranofotsy',1),
    (5, 05, 'Anosy',1),
    (6, 11, 'anosy',1)
;


insert into "public".bon_commande (proforma, frais,tva) values
    (1, 2000,10.0)
;

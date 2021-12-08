
--------------------------------------Actualité--------------------------------

-- 1
SELECT * FROM t_actualite_act;

--2
SELECT * FROM t_actualite_act WHERE act_id = 1;

--3
SELECT act_id FROM t_actualite_act ORDER BY act_id DESC LIMIT 5;

--4
SELECT act_id FROM t_actualite_act WHERE act_contenu like '% de %';

--5
SELECT act_id, cpt_pseudo FROM t_actualite_act WHERE act_date like '2021-10-04%';

--6
--7
--8
--9
--10
--11

--------------------------------------Passeports / posts--------------------------------
--1. Requête listant tous les passeports
SELECT * FROM t_passeport_pas;

--2. Requête listant tous les passeports associés à un invité dont connaît l’ID (ou n°)
SELECT * FROM t_passeport_pas WHERE cpt_pseudo = 'frenchWargameStudio';

--3. Requête d’ajout d’un nouveau passeport
INSERT INTO t_passeport_pas VALUES(NULL,'pasLogin','pasMDP','frenchWargameStudio','D');

--4. Requête de modification d’un passeport (ex : passMDP)
UPDATE t_passeport_pas SET pas_mdp = '1234' WHERE pas_id = 7;

--5. Requête de désactivation d’un passeport
UPDATE t_passeport_pas SET pas_etat = 'D' WHERE pas_id = 7;

--6. Requête de suppression d’un passeport
DELETE FROM t_passeport_pas WHERE pas_id = 7;

--7. Requête listant tous les posts
SELECT * FROM t_post_pst;

--8. Requête / code SQL d’ajout d’un post de 140 caractères maximum
--INSERT INTO t_post_pst VALUES(NULL,'En plus de couvrir l\'évenèment, nous participons aussi au tournoi en équipe, et pas avec n\'importe qui... avec l\'équipe de France!!!', NOW(),1,'A');

--9. Requête de modération (désactivation) d’un post
UPDATE t_post_pst SET pst_etat = 'D' WHERE pst_id=3;

--10. Requête de suppression d’un post en particulier
DELETE FROM t_post_pst WHERE pst_id=3;

--11. Requête de suppression de tous les posts d’un invité en particulier
DELETE FROM t_post_pst WHERE pst_id in (SELECT pst_id FROM t_post_pst JOIN t_passeport_pas USING(pas_id) JOIN t_invite_inv USING(cpt_pseudo) WHERE cpt_pseudo='frenchWargameStudio');

--12. Requête listant tous les posts associés à un invité particulier
SELECT pst_id, pst_text, pst_date FROM t_post_pst JOIN t_passeport_pas USING(pas_id) JOIN t_invite_inv USING(cpt_pseudo) WHERE cpt_pseudo like 'frenchWargameStudio';

--13. Requête listant tous les invités n’ayant pas de post
SELECT cpt_pseudo, inv_nom FROM t_invite_inv EXEPT SELECT cpt_pseudo, inv_nom FROM t_invite_inv JOIN t_passeport_pas USING(cpt_pseudo) JOIN t_post_pst USING(pas_id);


----------------------------------Profils----------------------------------
--1
SELECT * from t_compte_cpt LEFT OUTER JOIN t_organisateur_org USING(cpt_pseudo) LEFT outer join t_invite_inv USING(cpt_pseudo) order by cpt_statut;

--2
SELECT cpt_pseudo from t_compte_cpt where cpt_pseudo = $pseudo and cpt_mdp = $mdp;

--3
SELECT * from t_compte_cpt LEFT OUTER JOIN t_organisateur_org USING(cpt_pseudo) LEFT outer join t_invite_inv USING(cpt_pseudo) WHERE cpt_pseudo= 'frenchWargameStudio';

--4
UPDATE t_compte_cpt SET cpt_mdp = '' where cpt_pseudo like 'frenchWargameStudio';

--5
--6
--7
--8


-----------------------------Données des invités--------------------------
--1. Requête listant toutes les données de tous les invités
SELECT inv_nom, inv_description, inv_image from t_invite_inv;

--2. Requête donnant les données d'un invité à partir de son ID (ou n°)
SELECT inv_nom, inv_description, inv_image from t_invite_inv WHERE cpt_pseudo like 'frenchWargameStudio';

--3. Requête(s) listant les données d'un invité à partir de son ID (ou n°) + toutes les animations auxquelles il participe
SELECT inv_nom, ani_libelle, ani_description, ani_horaireDebut, ani_horaireFin from t_invite_inv join tj_intervenir_itv USING(cpt_pseudo) JOIN t_animation_ani USING(ani_id) where cpt_pseudo like 'frenchWargameStudio';

--4. Requête de mise à jour des données d'un invité
UPDATE t_invite_inv SET ... WHERE cpt_pseudo = 'frenchWargameStudio';

--5. Requête de recherche d'un invité via un mot-clé contenu dans sa biographie
SELECT inv_nom, inv_description, inv_image from t_invite_inv WHERE inv_description like '% créateur %';

--6. Requête(s) / Code SQL de suppression des données d'un invité en particulier (connaissant son ID)
CALL delete_invite('invTEST');  --Voir la PROCEDURE de l'activite 5;



-----------------------------Animations---------------------------------
--1. Requête listant toutes les animations, leur lieu et le nom du (ou des) invité(s)
SELECT ani_libelle, ani_description, ani_horaireDebut, ani_horaireFin, lie_libelle, inv_nom from t_invite_inv join tj_intervenir_itv USING(cpt_pseudo) JOIN t_animation_ani USING(ani_id) JOIN t_lieu_lie USING(lie_id) ORDER BY ani_libelle;

SELECT ani_libelle, ani_description, ani_horaireDebut, ani_horaireFin, lie_libelle, GROUP_CONCAT(inv_nom) from t_invite_inv right outer join tj_intervenir_itv USING(cpt_pseudo) JOIN t_animation_ani USING(ani_id) JOIN t_lieu_lie USING(lie_id) ORDER BY ani_libelle;

--2. Requête qui récupère dans la table de gestion des animations les données d'une animation en particulier (connaissant son ID / son intitulé)
SELECT ani_libelle, ani_description, ani_horaireDebut, ani_horaireFin, lie_libelle, inv_nom from t_invite_inv join tj_intervenir_itv USING(cpt_pseudo) JOIN t_animation_ani USING(ani_id) JOIN t_lieu_lie USING(lie_id) where ani_id = 1;
SELECT * from t_animation_ani where ani_id = 1;

--3. Requête donnant toutes les animations sur une plage horaire (ex : matin)
SELECT * from t_animation_ani where ani_horaireDebut BETWEEN '2021-10-04 08:00:00' AND '2021-10-04 12:00:00';
SELECT * from t_animation_ani where ani_horaireDebut BETWEEN HOUR('08:00:00') AND HOUR('12:00:00');

--4. Requête donnant toutes les animations sur un lieu et une plage horaire
SELECT ani_libelle, lie_libelle from t_animation_ani JOIN t_lieu_lie USING(lie_id) where lie_id=2 AND ani_horaireDebut BETWEEN '2021-10-04 08:00:00' AND '2021-10-04 12:00:00';

--5. Requête récupérant toutes les animations d'un invité (connaissant son ID)
SELECT inv_nom, ani_libelle FROM t_invite_inv JOIN tj_intervenir_itv USING(cpt_pseudo) JOIN t_animation_ani USING(ani_id) WHERE cpt_pseudo like 'wargameSpirit';

--6. Requête qui liste les animations collectives + nom des invités
SELECT ani_libelle, GROUP_CONCAT(inv_nom), COUNT(ani_id) FROM t_invite_inv JOIN tj_intervenir_itv USING(cpt_pseudo) JOIN t_animation_ani USING(ani_id) GROUP BY ani_libelle HAVING COUNT(ani_id) > 1;

--7. Requête d'ajout d'une animation avec précision du lieu et du (des) invité(s) concerné(s) !
INSERT INTO t_animation_ani VALUES(NULL,'Animation','Animation Description',NOW(),NOW(),1);
INSERT INTO tj_intervenir_itv VALUES((SELECT ani_id FROM t_animation_ani WHERE ani_libelle = 'Animation'),'invTEST');
INSERT INTO tj_intervenir_itv VALUES((SELECT ani_id FROM t_animation_ani WHERE ani_libelle = 'Animation'),'frenchWargameStudio');

--8. Requête de mise à jour des données d'une animation dont on connaît l'ID
UPDATE t_animation_ani SET ... WHERE ani_id = 14;

--9. Requête(s) de suppression de toutes les participations à des animations d'un invité en particulier (connaissant son ID) !?
DELETE FROM tj_intervenir_itv WHERE cpt_pseudo = 'invTEST';

--10. Requête(s) / Code SQL de suppression des données d'une animation en particulier (connaissant son ID) !?
DROP PROCEDURE IF EXISTS delete_animation;
DELIMITER //
CREATE PROCEDURE delete_animation(in animationID int)
BEGIN
    DELETE FROM tj_intervenir_itv WHERE ani_id = animationID;
    DELETE FROM t_animation_ani WHERE ani_id = animationID;
END;
//
DELIMITER ;
--TEST
CALL delete_animation(14);


------------------------Lieux/Services--------------------------
--1
SELECT * from t_lieu_lie;

--2
SELECT * from t_lieu_lie where lie_libelle like 'Wargame Spirit' or lie_id = 1;

--3
select srv_nom from t_service_srv join t_lieu_lie USING(lie_id) WHERE lie_id = 1;

--4
SELECT lie_libelle FROM t_lieu_lie WHERE lie_id NOT IN(SELECT lie_id FROM t_lieu_lie JOIN t_service_srv USING(lie_id));

--5
SELECT lie_libelle, GROUP_CONCAT(ani_libelle) as Animations FROM t_animation_ani JOIN t_lieu_lie USING(lie_id) WHERE lie_id = 1;

--6
--7
--8
--9








-----------------------------------------SQL-DML-------------------------------------------------
--WEB4EVENT--

SELECT cpt_pseudo, act_contenu FROM t_compte_cpt left outer join t_actualite_act USING(cpt_pseudo);

SELECT cpt_pseudo from t_compte_cpt where cpt_statut = 'O' EXCEPT SELECT cpt_pseudo from t_actualite_act;
/* ou */SELECT cpt_pseudo from t_compte_cpt where cpt_statut = 'O' AND cpt_pseudo not in(SELECT cpt_pseudo from t_actualite_act);


--Activité 2

DROP FUNCTION IF EXISTS invite_animation;
DELIMITER //
CREATE FUNCTION invite_animation(idAnimation INT) RETURNS VARCHAR(200)
BEGIN
    DECLARE vretour varchar(200) DEFAULT 0;
    SET vretour := (SELECT GROUP_CONCAT(CONCAT(" ",inv_nom)) from t_invite_inv join tj_intervenir_itv USING(cpt_pseudo) JOIN t_animation_ani USING(ani_id) WHERE ani_id = idAnimation);
    return vretour;
END;
//
DELIMITER ;

--TEST de la fonction
SELECT invite_animation(1);


--

/*
DROP PROCEDURE IF EXISTS insert_actualite;
DELIMITER //
CREATE PROCEDURE insert_actualite(idAnimation INT)
BEGIN
    DECLARE act_title VARCHAR(60) DEFAULT 'News pour \'';
    DECLARE act_text VARCHAR(300) DEFAULT (SELECT CONCAT(ani_libelle,", du ",DAY(ani_horaireDebut),"-",MONTH(ani_horaireDebut),"-",YEAR(ani_horaireDebut)," au ",DAY(ani_horaireFin),"-",MONTH(ani_horaireFin),"-",YEAR(ani_horaireFin),', avec :',(SELECT invite_animation(idAnimation)) ) from t_animation_ani where ani_id=idAnimation);

    SET act_title := (CONCAT(act_title,(SELECT ani_libelle from t_animation_ani where ani_id=idAnimation),'\''));

    INSERT INTO t_actualite_act VALUES(0,act_title,act_text,NOW(),'D','oragnisateur');
END;
//
DELIMITER ;
*/

--TEST de la procedure
CALL insert_actualite(1);



/*
Drop trigger if exists new_invite_animation;
DELIMITER //
CREATE TRIGGER new_invite_animation
AFTER INSERT ON tj_intervenir_itv
FOR EACH ROW
BEGIN
    DECLARE act_title VARCHAR(60) DEFAULT (CONCAT('News pour \'',(SELECT ani_libelle from t_animation_ani where ani_id=NEW.ani_id),'\''));

    DELETE FROM t_actualite_act WHERE act_titre = act_title;
    CALL insert_actualite(NEW.ani_id);
END;
//
DELIMITER ;
*/

--TEST du TRIGGER
insert INTO tj_intervenir_itv VALUES (4,'gamesWorkshop');




/* ACTIVITE 3 */
drop procedure if EXISTS nb_animation;
DELIMITER //
CREATE PROCEDURE nb_animation(out nb_passe int, out nb_en_cours int, out nb_a_venir int)
BEGIN
    Select count(DISTINCT(ani_id)) INTO nb_passe FROM t_animation_ani WHERE ani_horaireDebut < NOW();
    Select count(DISTINCT(ani_id)) INTO nb_en_cours FROM t_animation_ani WHERE ani_horaireDebut <= NOW() AND ani_horaireFin >= NOW();
    Select count(DISTINCT(ani_id)) INTO nb_a_venir FROM t_animation_ani WHERE ani_horaireDebut > NOW();
END;
//
DELIMITER ;


--TEST de la procedure
call nb_animation(@nb_passe, @nb_en_cours, @nb_a_venir); SELECT @nb_passe, @nb_en_cours, @nb_a_venir;




/* -----------------------------ACTIVITE 4----------------------------- */

/*TRIGGER 1*/
DROP TRIGGER IF EXISTS modif_actu;
DELIMITER //
CREATE TRIGGER modif_actu 
AFTER UPDATE
ON t_animation_ani
FOR EACH ROW
BEGIN
    IF(old.ani_libelle = new.ani_libelle or old.ani_description = new.ani_description or old.ani_horaireDebut = new.ani_horaireDebut or old.ani_horaireFin = new.ani_horaireFin or old.lie_id = new.lie_id)THEN
        IF(old.ani_libelle != new.ani_libelle and old.ani_description = new.ani_description and old.ani_horaireDebut = new.ani_horaireDebut and old.ani_horaireFin = new.ani_horaireFin and old.lie_id = new.lie_id) THEN
    	    INSERT INTO t_actualite_act VALUES(NULL, CONCAT('Changement sur ', old.ani_libelle), CONCAT('L animation ',old.ani_libelle,' s appelle desormais ',new.ani_libelle), NOW(), 'D', 'organisateur');
        ELSEIF(old.ani_libelle = new.ani_libelle and old.ani_description != new.ani_description and old.ani_horaireDebut = new.ani_horaireDebut and old.ani_horaireFin = new.ani_horaireFin and old.lie_id = new.lie_id) THEN
            INSERT INTO t_actualite_act VALUES(NULL,CONCAT('Changement sur ', old.ani_libelle),CONCAT('L animation ',old.ani_libelle,' change sa description. Voici la nouvelle : ',new.ani_description),CURDATE(),'D','organisateur');
        ELSEIF(old.ani_libelle = new.ani_libelle and old.ani_description = new.ani_description and old.ani_horaireDebut != new.ani_horaireDebut and old.ani_horaireFin = new.ani_horaireFin and old.lie_id = new.lie_id) THEN
            INSERT INTO t_actualite_act VALUES(NULL,CONCAT('Changement d horaire sur ', old.ani_libelle),CONCAT('L animation ',old.ani_libelle,' commence desormais a ',new.ani_horaireDebut),CURDATE(),'D','organisateur');
        ELSEIF(old.ani_libelle = new.ani_libelle and old.ani_description = new.ani_description and old.ani_horaireDebut = new.ani_horaireDebut and old.ani_horaireFin != new.ani_horaireFin and old.lie_id = new.lie_id) THEN
            INSERT INTO t_actualite_act VALUES(NULL,CONCAT('Changement d horaire sur ', old.ani_libelle),CONCAT('L animation ',old.ani_libelle,' fini desormais a ',new.ani_horaireFin),CURDATE(),'D','organisateur');
        ELSEIF(old.ani_libelle = new.ani_libelle and old.ani_description = new.ani_description and old.ani_horaireDebut = new.ani_horaireDebut and old.ani_horaireFin = new.ani_horaireFin and old.lie_id != new.lie_id) THEN
            INSERT INTO t_actualite_act VALUES(NULL,CONCAT('Changement de lieu sur ', old.ani_libelle),CONCAT('L animation ',old.ani_libelle,' a désormais lieu a ',(Select lie_libelle from t_lieu_lie where lie_id = new.lie_id)),CURDATE(),'D','organisateur');
        ELSE
            INSERT INTO t_actualite_act VALUES(NULL,CONCAT('Changement MAJEUR sur ', old.ani_libelle),'Il y a eu des changement sur cette animation, veuillez consulter les informations sur la page de l animation',CURDATE(),'D','organisateur');

        END IF;
    END IF;
END;
//
DELIMITER ;

--TEST DU TRIGGER 1
update t_animation_ani set ani_libelle='1234' where ani_id=9;
update t_animation_ani set ani_libelle='12345', set ani_description='12345' where ani_id=9;



/*TRIGGER 2*/

DROP TRIGGER IF EXISTS delete_actualite_animation;
DELIMITER //
CREATE TRIGGER delete_actualite_animation
AFTER DELETE
ON t_animation_ani
FOR EACH ROW
BEGIN
    DECLARE animation_name VARCHAR(100) DEFAULT old.ani_libelle;

    /*DESACTIVER LES ACTUALITES*/
    /*UPDATE t_actualite_act SET act_etat='D' WHERE act_contenu LIKE CONCAT('%',animation_name,'%');*/

    /*SUPPRIMER LES ACTUALITES*/
    DELETE FROM t_actualite_act WHERE act_contenu LIKE CONCAT('%',animation_name,'%');
END;
//
DELIMITER ;

--TEST DU TRIGGER 2
INSERT INTO `t_animation_ani` (`ani_id`, `ani_libelle`, `ani_description`, `ani_horaireDebut`, `ani_horaireFin`, `lie_id`) VALUES (NULL, 'lelibelle', 'la description', '2021-11-23 00:00:00', '2021-11-24 00:00:00', '3');
INSERT INTO t_actualite_act VALUES(NULL,'NEWS lelibelle','des new de l animation lelibelle',NOW(),'A','organisateur');
INSERT INTO t_actualite_act VALUES(NULL,'NEWS lelibelle','des new de l animation lelibelle',NOW(),'A','organisateur');
INSERT INTO t_actualite_act VALUES(NULL,'NEWS lelibelle','des new de l animation lelibelle',NOW(),'A','organisateur');
DELETE FROM t_animation_ani WHERE ani_libelle like 'lelibelle';






/*------------------------------------------------------------ ACTIVITE 5 -----------------------------------------------------------*/

/*--------------------VUE--------------------*/
/* TOUTS LES INVITE QUI N'INTERVIENNENT DANS AUCUNE ANIMATION*/
CREATE VIEW IF NOT EXISTS no_animation_invite
AS SELECT * FROM t_invite_inv WHERE cpt_pseudo NOT IN  (SELECT cpt_pseudo FROM tj_intervenir_itv);
/*TOUTES LES ANIMATIONS QUI N'ONT AUCON INVITES*/
CREATE VIEW IF NOT EXISTS no_invite_animataion
AS SELECT * FROM t_animation_ani WHERE ani_id NOT IN  (SELECT ani_id FROM tj_intervenir_itv);

/*--------------------FONCTION--------------------*/
DROP FUNCTION IF EXISTS info_animation;
DELIMITER //
CREATE FUNCTION info_animation(animationID INT) RETURNS VARCHAR(1000)
BEGIN
    DECLARE vretour VARCHAR(1000) DEFAULT 0;
    SELECT ani_libelle, ani_description, ani_horaireDebut, ani_horaireFin, lie_id INTO @animationLib, @animationDesc, @animationDeb, @animationFin, @animationLieu FROM t_animation_ani WHERE ani_id = animationID;
    SELECT lie_libelle, lie_adresse INTO @lieuLib, @lieuAdresse FROM t_lieu_lie WHERE lie_id = @animationLieu;
    SET vretour := CONCAT(@animationLib,'\n',@animationDesc,'\n\n Du ',@animationDeb,' au ',@animationFin,'\n\n Avec : \n',(SELECT invite_animation(animationID)),'\n\n Empacement : \n',@lieuLib,' : ',@lieuAdresse);
    RETURN vretour;
END;
//
DELIMITER ;
SELECT info_animation(9);

/*--------------------PROCEDURE--------------------*/
DROP PROCEDURE IF EXISTS delete_invite;
DELIMITER //
CREATE PROCEDURE delete_invite(in invite_pseudo VARCHAR(100))
BEGIN
    DELETE FROM tj_intervenir_itv WHERE cpt_pseudo = invite_pseudo;
    DELETE FROM tj_posseder_psd WHERE cpt_pseudo = invite_pseudo;

    /* Soit on désactive ses passeport (et ses post ou non) et on doit desactiver son compte*/
    UPDATE t_passeport_pas SET pst_etat='D' WHERE cpt_pseudo = invite_pseudo;
    /* A verifier si ça marche
    UPDATE t_post_pst SET pst_etat='D' WHERE pas_id IN (SELECT pas_id FROM t_passeport_pas WHERE cpt_pseudo = invite_pseudo);
    */
    UPDATE t_compte_cpt SET cpt_etat = 'D';

    /* soit on supprime tout */
    /*
    DELETE FROM t_post_pst WHERE pas_id IN (SELECT pas_id FROM t_passeport_pas WHERE cpt_pseudo = invite_pseudo);
    DELETE FROM t_passeport_pas WHERE cpt_pseudo = invite_pseudo;
    DELETE FROM t_invite_inv WHERE cpt_pseudo = invite_pseudo;
    DELETE FROM t_compte_cpt WHERE cpt_pseudo = invite_pseudo;
    */
END;
//
DELIMITER ;

--TEST DE LA PROCEDURE
INSERT INTO t_compte_cpt VALUES('invTEST','invTEST','A','I');
INSERT INTO t_invite_inv VALUES('invTEST','invTEST','','invTEST');
INSERT INTO tj_intervenir_itv VALUES(9,'invTEST');
INSERT INTO tj_intervenir_itv VALUES(4,'invTEST');
INSERT INTO tj_intervenir_itv VALUES(3,'invTEST');
INSERT INTO tj_posseder_psd VALUES(1,'invTEST');
INSERT INTO tj_posseder_psd VALUES(2,'invTEST');
INSERT INTO t_passeport_pas VALUES(NULL,'invTEST','invTEST','invTEST','A');

CALL delete_invite('invTEST');


/*--------------------TRIGGER--------------------*/

DROP TRIGGER IF EXISTS actualite_objetTrouve;
DELIMITER //
CREATE TRIGGER actualite_objetTrouve
AFTER INSERT ON t_objetTrouve_obj
FOR EACH ROW
BEGIN
    SELECT COUNT(DISTINCT(obj_id)) INTO @nbObjet FROM t_objetTrouve_obj WHERE tkt_numTicket IS NULL;
    
    DELETE FROM t_actualite_act WHERE act_titre like "Un objet perdu ?";
    INSERT INTO t_actualite_act VALUES(NULL,"Un objet perdu ?",CONCAT('Vous avez perdu quelque chose ? ',@nbObjet,' objets ont été retrouvé. Consulter la page des objets trouvés pour reclamer vos possession.'),NOW(),'A','organisateur');
END;
//
DELIMITER ;

--TEST DES TRIGGER 
INSERT INTO t_objetTrouve_obj VALUES(NULL,'Boite de dés',2,NULL);
INSERT INTO t_objetTrouve_obj VALUES(NULL,'Boite de dés',2,NULL);
INSERT INTO t_objetTrouve_obj VALUES(NULL,'Boite de dés',2,NULL);



DROP TRIGGER IF EXISTS update_actualite_objetTrouve;
DELIMITER //
CREATE TRIGGER update_actualite_objetTrouve
AFTER UPDATE ON t_objetTrouve_obj
FOR EACH ROW
BEGIN
    IF(old.tkt_numTicket is NULL AND new.tkt_numTicket IS NOT NULL) THEN
        SELECT COUNT(DISTINCT(obj_id)) INTO @nbObjet FROM t_objetTrouve_obj WHERE tkt_numTicket IS NULL;
        UPDATE t_actualite_act SET act_contenu = CONCAT('Vous avez perdu quelque chose ? ',@nbObjet,' objets ont été retrouvé. Consulter la page des objets trouvés pour reclamer vos possession.') WHERE act_titre like "Un objet perdu ?";
    END IF;
END;
//
DELIMITER ;






DROP FUNCTION IF EXISTS invite_url;
DELIMITER //
CREATE FUNCTION invite_url(cptPseudo VARCHAR(100)) RETURNS VARCHAR(1000)
BEGIN
    DECLARE vretour varchar(1000) DEFAULT 0;
    SET vretour := (SELECT GROUP_CONCAT(CONCAT("\n",url_lien)) from tj_posseder_psd JOIN t_url_url USING(url_id) WHERE cpt_pseudo = cptPseudo);
    return vretour;
END;
//
DELIMITER ;

--TEST de la fonction
SELECT invite_url('frenchWargameStudio');



DROP FUNCTION IF EXISTS animation_etat;
DELIMITER //
CREATE FUNCTION animation_etat(animationId INT) RETURNS VARCHAR(200)
BEGIN
    DECLARE vretour varchar(200) DEFAULT ' ';
    SELECT ani_horaireDebut, ani_horaireFin INTO @deb, @fin FROM t_animation_ani WHERE ani_id = animationId;
    IF(@fin < NOW())THEN
    	SET vretour := 'finie';
    ELSEIF(@deb < NOW() AND @fin > NOW())THEN
    	SET vretour := 'en cours';
    ELSEIF(@deb > NOW())THEN
    	SET vretour := 'à venir';
    END IF;
    return vretour;
END;
//
DELIMITER ;

SELECT animation_etat(1);


DROP TRIGGER IF EXISTS insert_invite_animation;
DELIMITER //
CREATE TRIGGER insert_invite_animation
BEFORE INSERT ON tj_intervenir_itv
FOR EACH ROW
BEGIN
    DECLARE nb_animation INT DEFAULT (SELECT MAX(ani_id) FROM tj_intervenir_itv WHERE cpt_pseudo = NEW.cpt_pseudo);
    WHILE nb_animation>0
    BEGIN
        SET nb_animation := nb_animation-1;
    END;
END;
//
DELIMITER ;
<?php

class Db_model extends CI_Model{

    

    public function __construct(){
        $this->load->database();
        $this->salt = "LE SEL DU NARRATEUR";
    }

    //----------------------------------------------------------------------------------------------
    //--------------------------------------------AUTRE---------------------------------------------
    //----------------------------------------------------------------------------------------------
    public function get_date(){
        $query = $this->db->query("SELECT CURDATE() AS date_now;");
        return $query->row();
    }


    //----------------------------------------------------------------------------------------------
    //--------------------------------------------COMPTE--------------------------------------------
    //----------------------------------------------------------------------------------------------
    //recuperation de tous les comptes
    public function get_all_compte(){
        $query = $this->db->query("SELECT cpt_pseudo FROM t_compte_cpt;");
        return $query->result_array();
    }

    //creation d'un compte
    public function set_compte(){
        $this->load->helper('url');

        $id=$this->input->post('id');
        $mdp=$this->input->post('mdp');

        //$salt = "LE SEL DU NARRATEUR";
        $mdp = hash('sha512', $mdp.$this->salt); // hashage + salage du mdp

        $req="INSERT INTO t_compte_cpt VALUES ('".$id."','".$mdp."', 'D', 'I');";
        $query = $this->db->query($req);
        return ($query);
    }


    //Verification pour connexion. Renvoie true si les informations rentré permettent de se connecter, false sinon
    public function connect_compte($username, $password){
        //$salt = "LE SEL DU NARRATEUR";
        $password = hash('sha512', $password.$this->salt); // hashage + salage du mdp

        $query = $this->db->query("SELECT cpt_pseudo, cpt_mdp FROM t_compte_cpt WHERE cpt_pseudo = '".$username."' AND cpt_mdp = '".$password."' AND cpt_etat = 'A' ");
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    //recuperation des informations d'un compte
    public function get_compte($cpt_pseudo){
        $query = $this->db->query("SELECT cpt_pseudo, cpt_statut, cpt_etat FROM t_compte_cpt WHERE cpt_pseudo = '".$cpt_pseudo."';");
        return $query->row();
    }

    //met a jour le mot de passe d'un compte
    public function update_mdp($cpt_pseudo, $cpt_mdp){
        //$salt = "LE SEL DU NARRATEUR";
        $cpt_mdp = hash('sha512', $cpt_mdp.$this->salt); // hashage + salage du mdp

        $query = $this->db->query("UPDATE t_compte_cpt SET cpt_mdp = '".$cpt_mdp."' where cpt_pseudo = '".$cpt_pseudo."';");
        if(!$query){
            return false;
        }else{
            return true;
        }
    }

    //----------------------------------------------------------------------------------------------
    //-------------------------------------------ACTUALITE------------------------------------------
    //----------------------------------------------------------------------------------------------
    //renvoie une anicualité en fonction de son ID
    public function get_actualite($numero){
        $query = $this->db->query("SELECT act_titre, act_contenu FROM t_actualite_act WHERE act_id=".$numero.";");
        return $query->row();
    }

    //renvoie toutes les actualités
    public function get_all_actualite(){
        //$query = $this->db->query("SELECT act_id, act_titre, act_contenu, DATE(act_date) AS act_date, cpt_pseudo FROM t_actualite_act WHERE act_etat='A' ORDER BY act_date DESC;");
        $query = $this->db->query("SELECT act_id, act_titre, act_contenu, act_date, cpt_pseudo FROM t_actualite_act WHERE act_etat='A' ORDER BY act_date DESC;");
        return $query->result_array();
    }


    //----------------------------------------------------------------------------------------------
    //-------------------------------------------ANIMATION------------------------------------------
    //----------------------------------------------------------------------------------------------
    //renvoie toutes les animations -- APPEL DE FONCTION
    public function get_all_animation(){
        //$query = $this->db->query("SELECT ani_id, ani_libelle, ani_description, DATE(ani_horaireDebut) as ani_horaireDebut, DATE(ani_horaireFin) as ani_horaireFin, lie_libelle, invite_animation(ani_id) AS invite FROM t_animation_ani JOIN t_lieu_lie USING(lie_id) ORDER BY ani_horaireDebut;");
        $query = $this->db->query("SELECT ani_id, ani_libelle, ani_description, ani_horaireDebut, ani_horaireFin, lie_id, lie_libelle, invite_animation(ani_id) AS invite, animation_etat(ani_id) as etat FROM t_animation_ani JOIN t_lieu_lie USING(lie_id) ORDER BY ani_horaireDebut;");
        return $query->result_array();
    }

    //renvoie les infos d'une animation donné -- APPEL DE FONCTION
    public function get_animation($id_animation){
        $query = $this->db->query("SELECT ani_id, ani_libelle, ani_description, ani_horaireDebut, ani_horaireFin, lie_id, lie_libelle, invite_animation(ani_id) AS invite, animation_etat(ani_id) as etat FROM t_animation_ani JOIN t_lieu_lie USING(lie_id) WHERE ani_id = ".$id_animation.";");
        return $query->row();
    }

    //renvoie les invités d'une animation donné, concaténé dans une chaine
    public function get_invite_animation($id_animation){
        $query = $this->db->query("SELECT invite_animation(".$id_animation.");");
        return $query->row();
    }

    // revoie les animations d'un invité donné
    public function get_animation_invite($cpt_pseudo){
        $query = $this->db->query("SELECT ani_id, ani_libelle, ani_description, ani_horaireDebut, ani_horaireFin, lie_id FROM t_animation_ani ORDER BY ani_horaireDebut;");
        return $query->result_array();
    }

    //suppression d'une animation -- APPEL DE PROCEDURE
    public function delete_animation($ani_id){
        $query = $this->db->query("CALL delete_animation(".$ani_id.")");
    }

    //UPDATE une animation
    public function update_animation(){

    }

    //----------------------------------------------------------------------------------------------
    //--------------------------------------------INVITE--------------------------------------------
    //----------------------------------------------------------------------------------------------
    //renvoie toutes les infos de tous les invités (url, passeport, post)
    public function get_all_invite_infos(){
        $query = $this->db->query("SELECT inv_nom, inv_description, inv_image, cpt_pseudo, url_lien, pst_text, pst_date, pst_etat FROM t_url_url JOIN tj_posseder_psd USING(url_id) RIGHT OUTER JOIN t_invite_inv USING(cpt_pseudo) LEFT OUTER JOIN t_passeport_pas USING(cpt_pseudo) LEFT OUTER JOIN t_post_pst USING(pas_id) ORDER BY pst_date DESC;");
        return $query->result_array();
    }

    //renvoie touts les infos d'une animation en particulier 
    public function get_all_invite_infos_animation($ani_id){
        $query = $this->db->query("SELECT inv_nom, inv_description, inv_image, cpt_pseudo, url_lien, pst_text, pst_date, pst_etat FROM t_url_url JOIN tj_posseder_psd USING(url_id) RIGHT OUTER JOIN t_invite_inv USING(cpt_pseudo) LEFT OUTER JOIN t_passeport_pas USING(cpt_pseudo) LEFT OUTER JOIN t_post_pst USING(pas_id) WHERE cpt_pseudo in(SELECT cpt_pseudo FROM tj_intervenir_itv WHERE ani_id = ".$ani_id.") ORDER BY pst_date DESC;");
        return $query->result_array();
    }

    //renvoie toutes les infos d'un invité (url, passeport, post)
    public function get_invite($pseudo){
        $query = $this->db->query("SELECT inv_nom, inv_description, inv_image, cpt_pseudo, url_lien, pas_id, pas_login, pas_etat, pst_text, pst_date, pst_etat FROM t_url_url JOIN tj_posseder_psd USING(url_id) RIGHT OUTER JOIN t_invite_inv USING(cpt_pseudo) LEFT OUTER JOIN t_passeport_pas USING(cpt_pseudo) LEFT OUTER JOIN t_post_pst USING(pas_id) WHERE cpt_pseudo = '".$pseudo."' ORDER BY pst_date DESC;");
        return $query->result_array();
    }

    //UPDATE les infos d'un invite
    public function update_invite($inv_nom,$inv_description,$cpt_pseudo){
        $inv_description=addslashes($inv_description);
        $query = $this->db->query("UPDATE t_invite_inv SET inv_nom='".$inv_nom."', inv_description='".$inv_description."' WHERE cpt_pseudo='".$cpt_pseudo."' ");

    }

    //----------------------------------------------------------------------------------------------
    //-----------------------------------------ORGANISTEUR------------------------------------------
    //----------------------------------------------------------------------------------------------
    //renvoie les informations d'un organisateur en particuliers
    public function get_organisateur($cpt_pseudo){
        $query = $this->db->query("SELECT org_nom, org_prenom, org_mail, cpt_pseudo FROM t_organisateur_org WHERE cpt_pseudo = '".$cpt_pseudo."';");
        return $query->result_array();
    }

    public function update_organisateur($org_prenom,$org_nom,$org_mail,$cpt_pseudo){
        $query = $this->db->query("UPDATE t_organisateur_org SET org_prenom='".$org_prenom."', org_nom='".$org_nom."', org_mail='".$org_mail."' WHERE cpt_pseudo='".$cpt_pseudo."' ");
    }

    //----------------------------------------------------------------------------------------------
    //---------------------------------------------LIEU---------------------------------------------
    //----------------------------------------------------------------------------------------------
    //renvoie tout les lieu
    public function get_all_lieu(){
        $query = $this->db->query("SELECT lie_id, lie_libelle, lie_adresse, srv_id, srv_nom FROM t_lieu_lie LEFT OUTER JOIN t_service_srv USING(lie_id) ORDER BY lie_libelle;");
        return $query->result_array();
    }

    //renvoie les infos d'un lieu en particuliers
    public function get_lieu($lie_id){
        $query = $this->db->query("SELECT lie_id, lie_libelle, lie_adresse, srv_id, srv_nom FROM t_lieu_lie LEFT OUTER JOIN t_service_srv USING(lie_id) WHERE lie_id = ".$lie_id.";");
        return $query->result_array();
    }

    //----------------------------------------------------------------------------------------------
    //------------------------------------------PASSEPORT-------------------------------------------
    //----------------------------------------------------------------------------------------------
    //Test la connection d'un passeport. Renvoie l'id du passeport et le pseudo du compte si la connection réussi, faux sinon
    public function connect_passeport($pas_login,$pas_mdp){
        $pas_login = addslashes($pas_login);
        $pas_mdp = hash('sha512', $pas_mdp.$this->salt); // hashage + salage du mdp

        $query = $this->db->query("SELECT pas_id, cpt_pseudo FROM t_passeport_pas WHERE pas_login = '".$pas_login."' AND pas_mdp = '".$pas_mdp."' AND pas_etat = 'A' ");
        if($query->num_rows()>0){
            return $query->row();
        }else{
            return false;
        }
    }


    //----------------------------------------------------------------------------------------------
    //---------------------------------------------POST---------------------------------------------
    //----------------------------------------------------------------------------------------------
    //Insert un post dans la base de données
    public function insert_post($pst_text,$pas_id){
        $pst_text = addslashes($pst_text);
        
        $query = $this->db->query("INSERT INTO t_post_pst VALUES(NULL,'".$pst_text."',NOW(),'".$pas_id."','A')");
        if(!$query){
            return false;
        }else{
            return true;
        }
    }

}



?>
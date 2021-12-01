<?php

class Db_model extends CI_Model{

    

    public function __construct(){
        $this->load->database();
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

        $salt = "LE SEL DU NARRATEUR";
        $mdp = hash('sha512', $mdp.$salt); // hashage + salage du mdp

        $req="INSERT INTO t_compte_cpt VALUES ('".$id."','".$mdp."', 'D', 'I');";
        $query = $this->db->query($req);
        return ($query);
    }


    //Verification pour connexion. Renvoie true si les informations rentré permettent de se connecter, false sinon
    public function connect_compte($username, $password){
        $salt = "LE SEL DU NARRATEUR";
        $password = hash('sha512', $password.$salt); // hashage + salage du mdp

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

    public function update_mdp($cpt_pseudo, $cpt_mdp){
        $salt = "LE SEL DU NARRATEUR";
        $cpt_mdp = hash('sha512', $cpt_mdp.$salt); // hashage + salage du mdp

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
    //renvoie toutes les animations
    public function get_all_animation(){
        //$query = $this->db->query("SELECT ani_id, ani_libelle, ani_description, DATE(ani_horaireDebut) as ani_horaireDebut, DATE(ani_horaireFin) as ani_horaireFin, lie_libelle, invite_animation(ani_id) AS invite FROM t_animation_ani JOIN t_lieu_lie USING(lie_id) ORDER BY ani_horaireDebut;");
        $query = $this->db->query("SELECT ani_id, ani_libelle, ani_description, ani_horaireDebut, ani_horaireFin, lie_id, lie_libelle, invite_animation(ani_id) AS invite, animation_etat(ani_id) as etat FROM t_animation_ani JOIN t_lieu_lie USING(lie_id) ORDER BY ani_horaireDebut;");
        return $query->result_array();
    }

    //renvoie les infos d'une animation donné
    public function get_animation($id_animation){
        $query = $this->db->query("SELECT ani_id, ani_libelle, ani_description, ani_horaireDebut, ani_horaireFin, lie_libelle, invite_animation(ani_id) AS invite, animation_etat(ani_id) as etat FROM t_animation_ani JOIN t_lieu_lie USING(lie_id) WHERE ani_id = ".$id_animation.";");
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

    //----------------------------------------------------------------------------------------------
    //--------------------------------------------INVITE--------------------------------------------
    //----------------------------------------------------------------------------------------------
    //renvoie toutes les infos de tous les invités (url, passeport, post)
    public function get_all_invite_infos(){
        $query = $this->db->query("SELECT inv_nom, inv_description, inv_image, cpt_pseudo, url_lien, pst_text, pst_date, pst_etat FROM t_url_url JOIN tj_posseder_psd USING(url_id) RIGHT OUTER JOIN t_invite_inv USING(cpt_pseudo) LEFT OUTER JOIN t_passeport_pas USING(cpt_pseudo) LEFT OUTER JOIN t_post_pst USING(pas_id) ORDER BY pst_date DESC;");
        return $query->result_array();
    }

    //renvoie toutes les infos d'un invité (url, passeport, post)
    public function get_invite($pseudo){
        $query = $this->db->query("SELECT inv_nom, inv_description, inv_image, cpt_pseudo, url_lien, pst_text, pst_date, pst_etat FROM t_url_url JOIN tj_posseder_psd USING(url_id) RIGHT OUTER JOIN t_invite_inv USING(cpt_pseudo) LEFT OUTER JOIN t_passeport_pas USING(cpt_pseudo) LEFT OUTER JOIN t_post_pst USING(pas_id) WHERE cpt_pseudo = '".$pseudo."' ORDER BY pst_date DESC;");
        return $query->result_array();
    }

    public function get_invite_alone($cpt_pseudo){
        $query = $this->db->query("SELECT inv_nom, inv_description, inv_image, cpt_pseudo FROM t_invite_inv WHERE cpt_pseudo = '".$cpt_pseudo."' ;");
        return $query->row();
    }

    //----------------------------------------------------------------------------------------------
    //-----------------------------------------ORGANISTEUR------------------------------------------
    //----------------------------------------------------------------------------------------------
    public function get_organisateur($cpt_pseudo){
        $query = $this->db->query("SELECT org_nom, org_prenom, org_mail, cpt_pseudo FROM t_organisateur_org WHERE cpt_pseudo = '".$cpt_pseudo."';");
        return $query->row();
    }


    //----------------------------------------------------------------------------------------------
    //---------------------------------------------LIEU---------------------------------------------
    //----------------------------------------------------------------------------------------------
    public function get_all_lieu(){
        $query = $this->db->query("SELECT lie_id, lie_libelle, lie_adresse, srv_id, srv_nom FROM t_lieu_lie JOIN t_service_srv USING(lie_id);");
        return $query->result_array();
    }

    public function get_lieu($lie_id){
        $query = $this->db->query("SELECT lie_id, lie_libelle, lie_adresse, srv_id, srv_nom FROM t_lieu_lie JOIN t_service_srv USING(lie_id) WHERE lie_id = ".$lie_id.";");
        return $query->result_array();
    }

}



?>
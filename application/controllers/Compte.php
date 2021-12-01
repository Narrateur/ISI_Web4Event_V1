<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Compte extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('db_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    //affiche tout les comptes
    public function lister(){
        $data['titre'] = 'Liste des pseudos :';
        $data['pseudos'] = $this->db_model->get_all_compte();
        $this->load->view('templates/haut');
        $this->load->view('compte_liste',$data);
        $this->load->view('templates/bas');
    }

    //creer un compte
    public function creer(){
        $this->load->helper("form");
        $this->load->library("form_validation");

        $this->form_validation->set_rules('id', 'id', 'required');
        $this->form_validation->set_rules('mdp', 'mdp', 'required');

        if ($this->form_validation->run() == FALSE){
            $this->load->view('templates/haut');
            $this->load->view('compte_creer');
            $this->load->view('templates/bas');
        }
        else{
            $this->db_model->set_compte();
            $this->load->view('templates/haut');
            $this->load->view('compte_succes');
        }
    }

    //permet de se connecter. Variables de SESSION : username -> cpt_pseudo || statut -> I (invité) ou O (organisateur)
    public function connecter()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('pseudo', 'pseudo', 'required');
        $this->form_validation->set_rules('mdp', 'mdp', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/haut');
            $this->load->view('compte_connecter');
            $this->load->view('templates/bas');

        }else{
            $username = $this->input->post('pseudo');
            $password = $this->input->post('mdp');
            if($this->db_model->connect_compte($username,$password)){
                
                //variable de session pour le pseudo
                $session_data = array('username' => $username );
                $this->session->set_userdata($session_data);

                //recupération dans une variable de session du role de l'utilisateur (Orga ou Invité)
                $statut = $this->db_model->get_compte($username);
                $session_data = array('statut' => $statut->cpt_statut);
                $this->session->set_userdata($session_data);

                //revoie sur les infos du compte
                $this->afficher($this->session->userdata('username'));
            }else{
                $this->load->view('templates/haut');
                $this->load->view('compte_connecter');
                $this->load->view('templates/bas');
            }
        }
    }

    //permet de changer de mdp
    public function changer_mdp(){
        $this->form_validation->set_rules('ancien_mdp', 'ancien_mdp', 'required');
        $this->form_validation->set_rules('new_mdp', 'new_mdp', 'required');
        $this->form_validation->set_rules('new_mdp_2', 'new_mdp_2', 'required');

        if ($this->session->userdata('username') == null){
            $this->load->view('templates/haut');
            $this->load->view('compte_connecter');
            $this->load->view('templates/bas');

        }else{
            $ancien_mdp = $this->input->post('ancien_mdp');
            $new_mdp = $this->input->post('new_mdp');
            $new_mdp_2 = $this->input->post('new_mdp_2');

            if($this->db_model->connect_compte($this->session->userdata('username'),$ancien_mdp)){
                if($new_mdp==$new_mdp_2){
                    $this->db_model->update_mdp($this->session->userdata('username'),$new_mdp);
                    redirect(base_url()."index.php");
                }
            }else{
                redirect(base_url()."index.php");
            }
        }
    }

    //affiche les information du compte connecter (privé)
    public function afficher($cpt_pseudo){
        
        if($this->session->userdata('statut') == 'I'){
            $data['infos'] = $this->db_model->get_invite_alone($cpt_pseudo);
        }else if($this->session->userdata('statut') == 'O'){
            $data['infos'] = $this->db_model->get_organisateur($cpt_pseudo);
        }
        $this->load->view('templates/haut');
        $this->load->view('compte_afficher',$data);
        $this->load->view('templates/bas');
    }

    //detruit la session pour redirige vers l'accueil
    public function deconnecter(){
        session_destroy();
        header("Refresh:0");
        redirect(base_url()."index.php");
    }
}